class FeedingManager {
    constructor() {
        this.isFeeding = false;
        this.startTime = null;
        this.timer = null;
        this.duration = 0;
    }

    async start() {
        if (this.isFeeding) return;
        
        if (!confirm('Deseja iniciar a amamentação?')) return;
        
        this.isFeeding = true;
        this.startTime = new Date();
        this.duration = 0;
        
        const timerDisplay = document.getElementById('timer');
        if (timerDisplay) {
            timerDisplay.style.display = 'block';
        }
        
        document.getElementById('feeding-button').textContent = 'Parar Amamentação';
        document.getElementById('feeding-button').classList.remove('btn-primary');
        document.getElementById('feeding-button').classList.add('btn-danger');
        
        this.timer = setInterval(() => this.updateTimer(), 1000);
    }

    async stop() {
        if (!this.isFeeding) return;
        
        if (!confirm('Deseja parar a amamentação?')) return;
        
        clearInterval(this.timer);
        const endTime = new Date();
        
        const quantity = prompt('Quantidade em ml (opcional):');
        
        try {
            console.log('Iniciando processo de parada da amamentação');
            
            const metaToken = document.querySelector('meta[name="csrf-token"]');
            if (!metaToken) {
                throw new Error('Meta tag do CSRF não encontrada');
            }

            const csrfToken = metaToken.getAttribute('content');
            if (!csrfToken) {
                throw new Error('Token CSRF não disponível');
            }

            const babySelector = document.getElementById('baby-selector');
            if (!babySelector) {
                throw new Error('Seletor de bebê não encontrado');
            }

            if (!babySelector.value) {
                throw new Error('Por favor, selecione um bebê');
            }

            const requestData = {
                baby_id: babySelector.value,
                started_at: this.startTime.toISOString(),
                ended_at: endTime.toISOString(),
                quantity: quantity ? parseInt(quantity) : null
            };

            console.log('Dados da requisição:', requestData);
            console.log('Token CSRF:', csrfToken);

            const response = await fetch('/dashboard/feeding', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(requestData)
            });

            console.log('Status da resposta:', response.status);
            const data = await response.json();
            console.log('Resposta do servidor:', data);

            if (!response.ok) {
                if (response.status === 422) {
                    const errorMessage = data.errors ? 
                        Object.values(data.errors).flat().join('\n') : 
                        data.message;
                    throw new Error(errorMessage);
                }
                throw new Error(data.message || `Erro HTTP: ${response.status}`);
            }

            if (!data.success) {
                throw new Error(data.message || 'Erro ao salvar amamentação');
            }

            this.updateHistory(data.feeding);
            this.reset();
            alert('Amamentação registrada com sucesso!');
            
        } catch (error) {
            console.error('Erro ao salvar amamentação:', error);
            alert('Erro ao salvar amamentação: ' + error.message);
            this.reset();
        }
    }

    updateTimer() {
        const now = new Date();
        this.duration = Math.floor((now - this.startTime) / 1000 / 60);
        const timerDisplay = document.getElementById('timer');
        if (timerDisplay) {
            const hours = Math.floor(this.duration / 60);
            const minutes = this.duration % 60;
            const seconds = Math.floor(((now - this.startTime) / 1000) % 60);
            timerDisplay.textContent = 
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }
    }

    reset() {
        this.isFeeding = false;
        this.startTime = null;
        this.duration = 0;
        clearInterval(this.timer);
        
        const timerDisplay = document.getElementById('timer');
        if (timerDisplay) {
            timerDisplay.style.display = 'none';
            timerDisplay.textContent = '00:00:00';
        }
        
        const button = document.getElementById('feeding-button');
        if (button) {
            button.textContent = 'Iniciar Amamentação';
            button.classList.remove('btn-danger');
            button.classList.add('btn-primary');
        }
    }

    updateHistory(feeding) {
        const historyContainer = document.querySelector('#feedingHistory');
        if (!historyContainer) {
            console.error('Container do histórico não encontrado');
            return;
        }

        const noHistoryMessage = historyContainer.querySelector('.text-muted');
        if (noHistoryMessage) {
            noHistoryMessage.remove();
        }

        const historyItem = document.createElement('div');
        historyItem.className = 'border rounded-lg p-4 hover:bg-gray-50 transition-colors';
        
        const startedAt = new Date(feeding.started_at);
        const formattedTime = startedAt.toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit'
        });
        const formattedDate = startedAt.toLocaleDateString('pt-BR');

        historyItem.innerHTML = `
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">
                        ${formattedTime}
                        - Duração: ${feeding.duration} minutos
                        ${feeding.quantity ? `- Quantidade: ${feeding.quantity}ml` : ''}
                    </p>
                </div>
                <span class="text-xs text-gray-500">
                    ${formattedDate}
                </span>
            </div>
        `;

        historyContainer.insertBefore(historyItem, historyContainer.firstChild);

        const allItems = historyContainer.querySelectorAll('.border');
        if (allItems.length > 3) {
            for (let i = 3; i < allItems.length; i++) {
                allItems[i].remove();
            }
        }

        if (historyContainer.querySelectorAll('.border').length === 0) {
            const noHistoryMessage = document.createElement('p');
            noHistoryMessage.className = 'text-muted text-center';
            noHistoryMessage.textContent = 'Nenhum registro de amamentação encontrado.';
            historyContainer.appendChild(noHistoryMessage);
        }
    }
}

// Inicialização quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    const feedingManager = new FeedingManager();
    
    const feedingButton = document.getElementById('feeding-button');
    if (feedingButton) {
        feedingButton.addEventListener('click', () => {
            if (feedingManager.isFeeding) {
                feedingManager.stop();
            } else {
                feedingManager.start();
            }
        });
    }

    // Event listeners para os alarmes
    document.querySelectorAll('.alarm-toggle').forEach(toggle => {
        toggle.addEventListener('change', async function() {
            const alarmId = this.dataset.alarmId;
            try {
                const response = await fetch(`/dashboard/alarm/${alarmId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await response.json();
                if (!data.success) {
                    throw new Error(data.message);
                }
            } catch (error) {
                alert('Erro ao alterar estado do alarme: ' + error.message);
                this.checked = !this.checked; // Reverte a mudança em caso de erro
            }
        });
    });
}); 