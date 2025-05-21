@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e8c3c3;
    }

    .card.border-0.shadow-sm {
        background-color: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .btn-primary {
        background-color: #933b3b;
        border-color: #933b3b;
    }

    .btn-primary:hover {
        background-color: #7a2f2f;
        border-color: #7a2f2f;
    }

    .form-control {
        border-radius: 10px;
        background-color: #f5f5f5;
    }

    .text-primary {
        color: #933b3b !important;
    }

    a.text-primary:hover {
        text-decoration: underline;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color: #933b3b;">Crie sua conta</h2>
                        <p class="text-muted">Junte-se à nossa comunidade de mães</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmar Senha</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Criar Conta
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0">Já tem uma conta? <a href="{{ route('login') }}" class="text-primary">Entre aqui</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
