@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sobre Nós') }}</div>

                <div class="card-body">
                    <h2>Quem Somos</h2>
                    <p>Somos uma equipe dedicada a fornecer soluções inovadoras para nossos clientes. Nossa missão é tornar a tecnologia acessível e útil para todos.</p>
                    
                    <h3>Nossa História</h3>
                    <p>Fundada em 2024, nossa empresa nasceu da necessidade de simplificar processos complexos através da tecnologia. Ao longo dos anos, temos ajudado inúmeras empresas a alcançar seus objetivos.</p>
                    
                    <h3>Nossos Valores</h3>
                    <ul>
                        <li>Inovação constante</li>
                        <li>Compromisso com a qualidade</li>
                        <li>Foco no cliente</li>
                        <li>Transparência em todas as ações</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 