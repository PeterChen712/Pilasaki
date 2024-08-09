@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $question->title }}</h1>
    <p>{{ $question->content }}</p>
    <small>Asked by {{ $question->user->name }} {{ $question->created_at->diffForHumans() }}</small>

    <h2 class="mt-4">Answers</h2>
    @foreach ($question->answers as $answer)
        <div class="card mb-3 {{ $answer->is_accepted ? 'border-success' : '' }}">
            <div class="card-body">
                <p class="card-text">{{ $answer->content }}</p>
                <small>Answered by {{ $answer->user->name }} {{ $answer->created_at->diffForHumans() }}</small>
                
                @if (!$question->is_solved && auth()->id() === $question->user_id)
                    <form action="{{ route('answers.accept', $answer) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Accept this Answer</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    <h3 class="mt-4">Your Answer</h3>
    <form action="{{ route('answers.store', $question) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Answer</button>
    </form>
</div>
@endsection