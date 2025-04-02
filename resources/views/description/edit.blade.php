@extends('layouts.app')

@section('content')
    <h1>Edit Description</h1>
    <form action="{{ route('description.update', $description) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $description->title }}" required>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required>{{ $description->content }}</textarea>
        <button type="submit">Save</button>
    </form>
@endsection
