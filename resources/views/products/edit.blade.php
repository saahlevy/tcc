<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
</head>
<body>
    <a href="{{ route('products.index') }}">Voltar</a>
    <h1>Editar Produto</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
        <br><br>
        <label for="description">Descrição:</label>
        <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
        <br><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
