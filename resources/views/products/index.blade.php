<!DOCTYPE html>
<html>
<head>
    <title>Lista de Produtos</title>
</head>
<body>
    <a href="{{ route('products.create') }}">Cadastrar Produto</a>
    <br>
    <h1>Lista de Produtos</h1>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @forelse ($products as $product)
        ID: {{ $product->id }}<br>
        Nome: {{ $product->name }}<br>
        Descrição: {{ $product->description }}<br>
        <a href="{{ route('products.show', ['product' => $product->id]) }}">Visualizar</a><br>
        <a href="{{ route('products.edit', ['product' => $product->id]) }}">Editar</a><br>
        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tem certeza que quer apagar?')">Deletar</button>
        </form>
        <hr>
    @empty
        <p>Nenhum produto encontrado.</p>
    @endforelse
</body>
</html>
