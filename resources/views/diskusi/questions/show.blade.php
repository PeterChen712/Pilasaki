@extends('layouts.app')

@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="container">
    <h1>{{ $question->title }}</h1>
    <p>{{ $question->content }}</p>
    <small>Ditanyakan oleh <a href="{{ route('profile', $question->user->id) }}">{{ $question->user->name }}</a> {{ $question->created_at->diffForHumans() }}</small>

    <h2 class="mt-4">Jawaban</h2>
    @foreach ($question->answers as $answer)
        <div class="card mb-3 {{ $answer->is_accepted ? 'border-success' : '' }}">
            <div class="card-body">
                <p class="card-text">{!! $answer->content !!}</p>
                <small>Dijawab oleh {{ $answer->user->name }} {{ $answer->created_at->diffForHumans() }}</small>
               
                @if ($question->status != 'selesai' && auth()->id() === $question->user_id)
                    <form action="{{ route('answers.accept', $answer) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Terima Jawaban Ini</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    <h3 class="mt-4">Jawaban Anda</h3>
    @auth
        <form id="answer-form" action="{{ route('answers.store', $question) }}" method="POST">
            @csrf
            <div class="mb-3">
                <div id="editor-container" style="height: 200px;"></div>
                <input type="hidden" name="content" id="content">
            </div>
            <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
        </form>
    @else
        <p class="text-center">Anda harus <a href="{{ route('login') }}">login</a> atau <a href="{{ route('register') }}">daftar</a> terlebih dahulu untuk memberikan jawaban.</p>
    @endauth
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow'
    });

    var form = document.getElementById('answer-form');
    form.onsubmit = function() {
        var content = document.querySelector('input[name=content]');
        content.value = quill.root.innerHTML;

        // Validasi konten
        if (quill.getText().trim().length === 0) {
            alert('Jawaban tidak boleh kosong');
            return false;
        }
        return true;
    };
</script>
@endsection