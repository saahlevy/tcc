<!DOCTYPE html>
<html>
<head>
    <title>Editar Descrição</title>
</head>
<body>
    <a href="{{ route('descriptions.index') }}">Voltar</a>
    <h1>Editar Descrição</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('descriptions.update', $description) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $description->title) }}">
        <br><br>
        <label for="content">Conteúdo:</label>
        <textarea name="content" id="content">{{ old('content', $description->content) }}</textarea>
        <br><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
