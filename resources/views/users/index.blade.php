<!-- resources/views/users.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
</head>
<body>
    <a href="{{ route('users.create') }}">Cadastrar Usuário</a>
    <br>
    <h1>Lista de Usuários</h1>
    <p>Esta é a página de usuários.</p>

    @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
        
    @endif
    
    
    
    @forelse ($users as $user)
        ID: {{ $user->id }}<br>
        Nome: {{ $user->name }}<br> 
        E-mail: {{ $user->email }}<br>
        <a href="{{ route('users.show', ['user' => $user->id]) }}">Visualizar</a><br>
        <a href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a><br>
        
        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"  onclick="return confirm('tem certeza que quer apagar?')">Deletar</button>
        </form>
        <hr>
    @empty   
        
    @endforelse

</body>
</html>
