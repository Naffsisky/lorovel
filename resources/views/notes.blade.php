@extends('layouts.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/notes.css') }}" />
@endsection @section('content')
<main>
    <h1>~ My Notes ~</h1>
    <div class="create-note-button">
        <a href="{{ route('notes.create') }}" class="btn btn-success"
            >Create Note</a
        >
    </div>
    <div class="notes-content">
        @if(isset($notesData)) @foreach($notesData as $note)
        <div class="section">
            <h4>{{ $note['title'] }}</h4>
            <p>{{ $note['body'] }}</p>
            <p><b>#{{ $note['tags'] }}</b></p>
            <hr />
            <div class="button">
                <form
                    method="POST"
                    action="{{ route('notes.destroy', $note['id']) }}"
                    onsubmit="return confirm('Apakah anda yakin ingin menghapus note ini?');"
                >
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <a
                        href="{{ route('notes.edit', $note['id']) }}"
                        class="btn btn-primary"
                        >Edit</a
                    >
                </form>
            </div>
        </div>

        @endforeach
        <div class="clearfix"></div>
        @else
        <p>No notes available</p>
        @endif
    </div>
</main>
@endsection @section('script') @endsection
