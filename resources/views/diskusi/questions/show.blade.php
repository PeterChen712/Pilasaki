@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $question->title }}</h1>
    <p>{{ $question->content }}</p>
    <small>Ditanyakan oleh {{ $question->user->name }} {{ $question->created_at->diffForHumans() }}</small>

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
    <form action="{{ route('answers.store', $question) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection