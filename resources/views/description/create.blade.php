@extends('layouts.app')

@section('content')
    <h1>Create New Description</h1>
    <form action="{{ route('description.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea>
        <button type="submit">Save</button>
    </form>
@endsection
