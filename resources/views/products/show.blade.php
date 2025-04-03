<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Produto</title>
</head>
<body>
    <a href="{{ route('products.index') }}">Voltar</a>
    <h1>Visualizar Produto</h1>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    ID: {{ $product->id }}<br>
    Nome: {{ $product->name }}<br>
    Preço: {{ $product->price }}<br>
</body>
</html>
