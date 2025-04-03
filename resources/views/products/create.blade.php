<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Produto</title>
</head>
<body>
    <a href="{{ route('products.index') }}">Voltar</a>
    <h1>Cadastrar Produto</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        <br><br>
        <label for="price">Preço:</label>
        <input type="text" name="price" id="price" value="{{ old('price') }}">
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
