@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recursos') }}</div>

                <div class="card-body">
                    <h2>Recursos Disponíveis</h2>
                    <p>Esta é a página de recursos do sistema. Aqui você encontrará informações úteis e ferramentas para ajudar no seu trabalho.</p>
                    
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <h5 class="mb-1">Documentação</h5>
                            <p class="mb-1">Acesse a documentação completa do sistema.</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <h5 class="mb-1">Tutoriais</h5>
                            <p class="mb-1">Aprenda a usar o sistema com nossos tutoriais passo a passo.</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <h5 class="mb-1">Suporte</h5>
                            <p class="mb-1">Entre em contato com nossa equipe de suporte.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 