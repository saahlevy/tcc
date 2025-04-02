@extends('layouts.app')

@section('content')
    <h1>Descriptions</h1>
    <a href="{{ route('description.create') }}">Create New Description</a>
    <ul>
        @foreach ($descriptions as $description)
            <li>
                <a href="{{ route('description.show', $description) }}">{{ $description->title }}</a>
                <a href="{{ route('description.edit', $description) }}">Edit</a>
                <form action="{{ route('description.destroy', $description) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    {{ $descriptions->links() }} <!-- Add pagination links -->
@endsection
