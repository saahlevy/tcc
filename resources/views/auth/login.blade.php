@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e8c3c3;
    }

    .login-card {
        background-color: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    .btn-link {
        color: #933b3b;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-card">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: #933b3b;">Bem-vinda de volta!</h2>
                    <p class="text-muted">Entre na sua conta para continuar</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha:</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Lembrar-me
                        </label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                    </div>

                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Esqueceu sua senha?
                            </a>
                        @endif
                    </div>

                    <div class="text-center mt-3">
                        <p class="mb-0">Ainda não tem cadastro? <a href="{{ route('register') }}" class="text-primary">Cadastre-se</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
