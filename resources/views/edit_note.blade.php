@extends('layouts.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/notes.css') }}" />
<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50%;
    }

    form {
        max-width: 400px;
        width: 100%;
    }
</style>
@endsection @section('content')
<h1 class="text-center">Edit Note</h1>
<main>
    <form method="POST" action="{{ route('notes.update', $note['id']) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input
                type="text"
                class="form-control"
                name="title"
                value="{{ old('title', $note['title']) }}"
                required
            />

            <label for="body" class="form-label">Body:</label>
            <input
                type="text"
                class="form-control"
                name="body"
                value="{{ old('body', $note['body']) }}"
                required
            />

            <label for="tags" class="form-label">Tags:</label>
            <input
                type="text"
                class="form-control"
                name="tags"
                value="{{ old('tags', $note['tags']) }}"
                required
            />
        </div>
        <div style="text-align: right">
            <a href="{{ route('notes') }}" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</main>
@endsection @section('script') @endsection
