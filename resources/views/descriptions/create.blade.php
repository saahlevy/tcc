<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Descrição</title>
</head>
<body>
    <a href="{{ route('descriptions.index') }}">Voltar</a>
    <h1>Cadastrar Descrição</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('descriptions.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}">
        <br><br>
        <label for="content">Conteúdo:</label>
        <textarea name="content" id="content">{{ old('content') }}</textarea>
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
