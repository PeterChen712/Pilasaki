@extends('layouts.app')

@section('title', 'Diskusi')

@section('styles')


@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="container">
    <h1 id="question-title">{{ $question->title }}</h1>
    <p id="question-content">{{ $question->content }}</p>
    <small>Ditanyakan oleh <a href="{{ route('profile.show', $question->user->id) }}">{{ $question->user->name }}</a> {{ $question->created_at->diffForHumans() }}</small>

    @if (auth()->id() === $question->user_id)
        <button id="edit-question-btn" class="btn btn-warning btn-sm">Edit Pertanyaan</button>
        <form id="edit-question-form" class="d-none" action="{{ route('questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="edit-title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="edit-title" name="title" value="{{ $question->title }}" required>
            </div>
            <div class="mb-3">
                <label for="edit-content" class="form-label">Konten</label>
                <textarea class="form-control" id="edit-content" name="content" rows="10" required>{{ $question->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" id="cancel-edit-btn" class="btn btn-secondary">Batal</button>
        </form>
    @endif

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

    @auth
        @if (auth()->id() !== $question->user_id)
        <h3 class="mt-4">Jawaban Anda</h3>
            <form id="answer-form" action="{{ route('answers.store', $question) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div id="editor-container" style="height: 200px;"></div>
                    <input type="hidden" name="content" id="content">
                </div>
                <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
            </form>
        @else
        @endif
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

    // Edit question
    document.getElementById('edit-question-btn').addEventListener('click', function() {
        document.getElementById('edit-question-form').classList.remove('d-none');
    });

    document.getElementById('cancel-edit-btn').addEventListener('click', function() {
        document.getElementById('edit-question-form').classList.add('d-none');
    });

    document.getElementById('edit-question-form').addEventListener('submit', function(e) {
        e.preventDefault();

        var title = document.getElementById('edit-title').value;
        var content = document.getElementById('edit-content').value;

        fetch('{{ route('questions.update', $question) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PUT'
            },
            body: JSON.stringify({
                title: title,
                content: content
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update tampilan judul dan konten dengan data terbaru
                document.getElementById('question-title').innerText = data.question.title;
                document.getElementById('question-content').innerText = data.question.content;

                // Sembunyikan form edit setelah sukses mengupdate
                document.getElementById('edit-question-form').classList.add('d-none');
            } else {
                // Tampilkan pesan error jika ada masalah
                alert('Gagal mengupdate pertanyaan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    });

</script>
@endsection
