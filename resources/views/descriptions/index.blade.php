<!DOCTYPE html>
<html>
<head>
    <title>Lista de Descrições</title>
</head>
<body>
    <a href="{{ route('descriptions.create') }}">Cadastrar Nova Descrição</a>
    <h1>Lista de Descrições</h1>

    <ul>
        @foreach ($descriptions as $description)
            <li>
                <a href="{{ route('descriptions.show', $description) }}">{{ $description->title }}</a>
                <a href="{{ route('descriptions.edit', $description) }}">Editar</a>
                <form action="{{ route('descriptions.destroy', $description) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"  onclick="return confirm('tem certeza que quer apagar?')">Deletar</button>
                </form>
            </li>
        @endforeach
    </ul>
    {{ $descriptions->links() }}
</body>
</html>
