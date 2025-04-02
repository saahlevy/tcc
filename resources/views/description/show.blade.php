@extends('layouts.app')

@section('content')
    <h1>{{ $description->title }}</h1>
    <p>{{ $description->content }}</p>
    <a href="{{ route('description.edit', $description) }}">Edit</a>
    <form action="{{ route('description.destroy', $description) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('description.index') }}">Back</a>
@endsection
