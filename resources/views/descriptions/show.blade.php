<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Descrição</title>
</head>
<body>
    <a href="{{ route('descriptions.index') }}">Voltar</a>
    <h1>Visualizar Descrição</h1>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    ID: {{ $description->id }}<br>
    Título: {{ $description->title }}<br>
    Conteúdo: {{ $description->content }}<br>
</body>
</html>
