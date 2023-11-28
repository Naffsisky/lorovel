<!-- resources/views/edit_note.blade.php -->
@extends('layouts.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/notes.css') }}" />
@endsection @section('content')
<div class="container">
    <form method="POST" action="{{ route('notes.update', $note['id']) }}">
        @csrf @method('PUT')

        <label for="title">Title:</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $note['title']) }}"
            required
        />

        <label for="body">Body:</label>
        <textarea name="body" required>
{{ old('body', $note['body']) }}</textarea
        >

        <label for="tags">Tags:</label>
        <input
            type="text"
            name="tags"
            value="{{ old('tags', $note['tags']) }}"
            required
        />

        <button type="submit" class="btn btn-primary">Update Note</button>
    </form>
</div>
@endsection @section('script') @endsection
