@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($babies->isEmpty())
                <div class="card">
                    <div class="card-header">Registrar Novo Bebê</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('baby.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome do Bebê</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Data de Nascimento</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Dashboard</h5>
                            <select class="form-control w-auto" id="baby-selector">
                                @foreach($babies as $b)
                                    <option value="{{ $b->id }}" {{ $b->id === $baby->id ? 'selected' : '' }}>
                                        {{ $b->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Coluna de Amamentação -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Amamentação</div>
                            <div class="card-body">
                                <button id="feeding-button" class="btn btn-primary btn-block mb-3">
                                    Iniciar Amamentação
                                </button>
                                <div id="timer" class="text-center mb-3" style="display: none;">
                                    <h3>00:00:00</h3>
                                </div>
                                <div class="bg-white rounded-lg shadow p-6">
                                    <h2 class="text-lg font-semibold mb-4">Histórico de Amamentação</h2>
                                    <div id="feedingHistory" class="space-y-4">
                                        @forelse($feedings as $feeding)
                                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="text-sm text-gray-600">
                                                            {{ \Carbon\Carbon::parse($feeding->started_at)->format('H:i') }}
                                                            - Duração: {{ $feeding->duration }} minutos
                                                            @if($feeding->quantity)
                                                                - Quantidade: {{ $feeding->quantity }}ml
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <span class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($feeding->started_at)->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted text-center">Nenhum registro de amamentação encontrado.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna de Alarmes -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Alarmes</div>
                            <div class="card-body">
                                @foreach($alarms as $alarm)
                                    <div class="alarm-item d-flex justify-content-between align-items-center mb-2">
                                        <span>{{ $alarm->formatted_time }} - {{ $alarm->day_name }}</span>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input alarm-toggle" 
                                                id="alarm-{{ $alarm->id }}" 
                                                data-alarm-id="{{ $alarm->id }}"
                                                {{ $alarm->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="alarm-{{ $alarm->id }}"></label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Coluna de Dicas -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Dicas do Dia</div>
                            <div class="card-body">
                                <div class="tip-item mb-3">
                                    <h6>Postura Correta</h6>
                                    <p>Mantenha o bebê com a cabeça alinhada ao corpo e o queixo tocando o seio.</p>
                                </div>
                                <div class="tip-item">
                                    <h6>Hidratação</h6>
                                    <p>Beba bastante água durante a amamentação para manter a produção de leite.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/test.js') }}"></script>
<script src="{{ asset('js/feeding-manager.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const babySelector = document.getElementById('baby-selector');
    if (babySelector) {
        babySelector.addEventListener('change', function() {
            window.location.href = `{{ route('dashboard') }}?baby_id=${this.value}`;
        });
    }
});
</script>
@endpush

@endsection