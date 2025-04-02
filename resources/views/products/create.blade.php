<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Produto</title>
</head>
<body>
    <a href="{{ route('produto.index') }}">Voltar</a>
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
        <label for="description">Descrição:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
