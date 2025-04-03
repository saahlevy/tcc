@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center min-vh-75 py-5">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">Bem-vinda ao MaternArte</h1>
            <p class="lead mb-4">Um espaço acolhedor e informativo para mães de primeira viagem. Aqui você encontrará apoio, dicas e uma comunidade que entende sua jornada.</p>
            <div class="d-flex gap-3">
                <a href="/cadastro" class="btn btn-primary btn-lg">Começar Agora</a>
                <a href="/sobre" class="btn btn-outline-primary btn-lg">Saiba Mais</a>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                 alt="Mãe e bebê" 
                 class="img-fluid rounded shadow-lg">
        </div>
    </div>

    <div class="row py-5">
        <div class="col-12 text-center mb-5">
            <h2 class="fw-bold">Como Podemos Ajudar Você?</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="fas fa-book fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Guia Completo</h3>
                    <p class="text-muted">Informações essenciais sobre gravidez, parto e cuidados com o bebê.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Comunidade</h3>
                    <p class="text-muted">Conecte-se com outras mães e compartilhe experiências.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="fas fa-calendar-alt fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Acompanhamento</h3>
                    <p class="text-muted">Acompanhe o desenvolvimento do seu bebê e suas consultas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 