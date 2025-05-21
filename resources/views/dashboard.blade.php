@extends('layouts.app')

@section('styles')
<style>
    body {
        background-color: #e8c3c3;
    }

    /* Cards padrão */
    .card {
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 1.5rem;
    }

    .card-header {
        background-color: transparent;
        border-bottom: none;
        font-weight: 600;
        color: #933b3b;
        font-size: 1.25rem;
    }

    /* Inputs padrão */
    .form-control {
        border-radius: 20px;
        background-color: #f5f5f5;
        border: none;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
        padding: 10px 15px;
        font-size: 1rem;
    }

    .form-control:focus {
        background-color: white;
        box-shadow: 0 0 5px 2px rgba(147, 59, 59, 0.5);
        border: none;
        outline: none;
    }

    /* Botões padrão */
    .btn-primary {
        background-color: #933b3b;
        border-color: #933b3b;
        border-radius: 20px;
        min-width: 100px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #7a2f2f;
        border-color: #7a2f2f;
    }

    .btn-danger {
        background-color: #c0392b;
        border-color: #c0392b;
        border-radius: 20px;
        min-width: 100px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-danger:hover {
        background-color: #922b23;
        border-color: #922b23;
    }

    .btn-success {
        background-color: #27ae60;
        border-color: #27ae60;
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-success:hover {
        background-color: #1e8449;
        border-color: #1e8449;
    }

    /* Timer */
    .timer {
        font-size: 2.5em;
        font-weight: bold;
        color: #933b3b;
        margin: 20px 0;
        text-align: center;
    }

    /* Seção input escondida */
    .input-section {
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 20px;
        margin-top: 20px;
    }

    /* Registros */
    .registro {
        background-color: #fff;
        border-radius: 20px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: background-color 0.3s ease;
    }

    .registro:hover {
        background-color: #f8e5e5;
    }

    .registro strong {
        color: #4a5568;
    }

    /* Alarme */
    .alarm-item span {
        color: #4a4a4a;
    }

    /* Select baby selector */
    #baby-selector {
        border-radius: 20px;
        background-color: #f5f5f5;
        border: none;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
        padding: 8px 15px;
        font-size: 1rem;
    }

    #baby-selector:focus {
        outline: none;
        box-shadow: 0 0 5px 2px rgba(147, 59, 59, 0.5);
        background-color: white;
    }

    /* Dicas */
    .tip-item h6 {
        color: #933b3b;
        margin-bottom: 0.5rem;
    }

    .tip-item p {
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    .tip-item small {
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if($babies->isEmpty())
                <div class="card">
                    <div class="card-header">Registrar Novo Bebê</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('baby.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome do Bebê</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
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

                <div class="row">
                    <!-- Amamentação -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Amamentação</div>
                            <div class="card-body">
                                <div id="timer" class="timer">00:00</div>
                                
                                <div class="text-center mb-3">
                                    <button id="btnStart" class="btn btn-primary">Iniciar</button>
                                    <button id="btnStop" class="btn btn-danger" disabled>Parar</button>
                                </div>

                                <div id="inputSection" class="input-section" style="display: none;">
                                    <div class="mb-3">
                                        <label for="ml" class="form-label">Quantidade de leite (mL) <small>(opcional)</small>:</label>
                                        <input type="number" class="form-control" id="ml" placeholder="Ex: 120">
                                    </div>
                                    <button id="btnSave" type="button" class="btn btn-success btn-block mt-2">Salvar Registro</button>
                                </div>

                                <div class="mt-4">
                                    <h5>Registros</h5>
                                    <div id="registros" class="mt-3">
                                        @forelse($feedings as $feeding)
                                            <div class="registro">
                                                <strong>Data:</strong> {{ $feeding->started_at->format('d/m/Y H:i') }}<br>
                                                <strong>Duração:</strong> {{ $feeding->formatted_duration }}<br>
                                                <strong>Quantidade:</strong> {{ $feeding->quantity ? $feeding->quantity . ' mL' : 'não informado' }}
                                            </div>
                                        @empty
                                            <p class="text-muted text-center">Nenhum registro de amamentação encontrado.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alarmes -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Alarmes</div>
                            <div class="card-body">
                                @foreach($alarms as $alarm)
                                    <div class="alarm-item d-flex justify-content-between align-items-center mb-2">
                                        <span>{{ $alarm->formatted_time }} - {{ $alarm->day_name }}</span>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input alarm-toggle" 
                                                id="alarm-{{ $alarm->id }}" 
                                                data-alarm-id="{{ $alarm->id }}"
                                                {{ $alarm->is_active ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Dicas do Dia -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Dicas do Dia</div>
                            <div class="card-body">
                                <div id="tipsContainer">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Carregando...</span>
                                        </div>
                                    </div>
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
<script src="{{ asset('js/feeding-manager.js') }}"></script>
<script src="{{ asset('js/tips-manager.js') }}"></script>
@endpush

@endsection
