<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel</title>
</head>
<body>
    <a href="{{ route('users.index') }}">Voltar</a>

    <br>
    <H2>Cadastrar Usuario</H2>

    @if ($errors->any())

       
    @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
    @endforeach
    @endif
                
            
        
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        @method('POST')

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome Completo" value="{{ old('name') }}">
        <br><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Seu Email" value="{{ old('email') }}">
        <br><br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" placeholder="Senha com no mínimo 8 caracteres" value="{{ old('password') }}">
        <br><br>
        <button type="submit">Cadastrar</button>
</form>
</body>
</html>
