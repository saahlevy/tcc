<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('users.index') }}">listar</a><br>
    <a href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a>
    <br>

    <h1>Visualizar Usuários</h1>

    @if (session('success'))
    <p style="color: green">
        {{ session('success') }}
    </p>
    
    @endif

    ID: {{ $user->id }}<br>
    Nome: {{ $user->name }}<br>
    E-mail: {{ $user->email }}<br>
    Cadastrado: {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}<br>
    Editado: {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}<br>
    
    
</body>
</html>