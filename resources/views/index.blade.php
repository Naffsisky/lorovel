@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/todolist.css') }}" />
@endsection

@section('content')
<main class="container mt-4">
    <div class="row">
        <div class="col-lg-4">
            <div class="section kiri">
                <h2 class="headline">NOTES 🗒️</h2>
                <div class="notes">
                    <hr class="hr" />
                    @if(isset($notesData)) @foreach($notesData as $note)
                    <p class="notes-head"><b>Title</b></p>
                    <p>{{ $note['title'] }}</p>
                    <p class="notes-head"><b>Tags</b></p>
                    <p>{{ $note['tags'] }}</p>
                    <p class="notes-head"><b>Body</b></p>
                    <p>{{ $note['body'] }}</p>
                    <hr class="hr"/>
                    @endforeach @else
                    <p>No notes available</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="section tengah">
                <h2 class="headline">What are you list today?</h2>
                <div class="row justify-content-center">
                    <div class="col col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <textarea
                                    id="inputTodo"
                                    type="text"
                                    class="form-control mb-2"
                                ></textarea>
                                <button
                                    id="addTodo"
                                    class="btn btn-dark float-end"
                                >
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <hr class="hr-full"/>
                        <h4>My Agenda 📝</h4>
                        <ul id="todoList" class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="section kanan">
                <h2 class="headline">HOT NEWS 🔥</h2>
                <p id="time" class="times"></p>
                <p id="date" class="times"></p>
                <br />
              @if(isset($newsData))
                  @foreach($newsData as $news)
                    <p class="news"><b>{{ $news['title'] }}</b></p>
                    <p class="news">{{ $news['description'] }}</p>
                    <p class="news"><a class="readmore-news" href="{{ $news['url'] }}"> Read more </a></p>
                      <br/>
                  @endforeach
              @else
                  <p>No news available</p>
              @endif
            </div>
        </div>
    </div>
</main>
@endsection @section('script')
<script src="{{ asset('js/home.js') }}"></script>
@endsection
