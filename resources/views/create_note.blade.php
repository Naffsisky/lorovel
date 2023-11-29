@extends('layouts.master')

@section('css')
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
@endsection

@section('content')
<h1 class="text-center">Create Note</h1>
    <main>
            <form method="POST" action="{{ route('notes.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" name="title" required />

                    <label for="body" class="form-label">Body:</label>
                    <input type="text" class="form-control" name="body" required />

                    <label for="tags" class="form-label">Tags:</label>
                    <input type="text" class="form-control" name="tags" required />
                </div>
                <div style="text-align: right">
                    <button type="submit" class="btn btn-primary">Create Note</button>
                </div>
            </form>
    </main>
@endsection
