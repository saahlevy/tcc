<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <a href="{{ route('users.index') }}">Listar</a><br>
    <a href="{{ route('users.show', ['user' => $user->id]) }}">Visualizar</a>
    
    <br>
    <h1>Editar Usuários</h1>

    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())

       
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
        @endif

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome Completo" value="{{ old('name', $user->name) }}">
        <br><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Seu Email" value="{{ old('email', $user->email) }}">
        <br><br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" placeholder="Senha com no mínimo 8 caracteres" value="{{ old('password') }}">
        <br><br>
        <button type="submit">Salvar</button>
</form>

</body>
</html>