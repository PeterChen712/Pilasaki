<!-- resources/views/diskusi.blade.php -->
@extends('layouts.app')

@section('title', 'Diskusi - Forum Programmer')

@section('styles')
<style>
    .welcome-box {
        background-color: #e0f7fa;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .welcome-box a {
        color: #007bff;
        text-decoration: underline;
    }
    .sidebar {
        margin-top: 20px;
    }
    .sidebar .nav-link {
        padding: 10px 15px;
        color: #333;
        display: flex;
        align-items: center;
    }
    .sidebar .nav-link:hover {
        background-color: #f0f0f0;
        color: #007bff;
    }
    .sidebar .nav-icon {
        margin-right: 10px;
    }
    .top-coder {
        margin-top: 20px;
    }
    .top-coder h4 {
        margin-bottom: 10px;
    }
    .top-coder .coder {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .top-coder .coder img {
        border-radius: 50%;
        margin-right: 10px;
    }
    .discussion-list {
        margin-top: 20px;
    }
    .discussion-item {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .discussion-item .details {
        display: flex;
        flex-direction: column;
    }
    .discussion-item .meta {
        display: flex;
        align-items: center;
        color: #777;
    }
    .discussion-item .meta .views,
    .discussion-item .meta .comments {
        margin-right: 15px;
        display: flex;
        align-items: center;
    }
    .discussion-item .meta .views::before {
        content: '👁️';
        margin-right: 5px;
    }
    .discussion-item .meta .comments::before {
        content: '💬';
        margin-right: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="welcome-box">
                <h2>Selamat datang di Forum Programmer!</h2>
                <p>Forum diskusi untuk para programmer. Bantu selesaikan kendala mereka untuk mendapatkan point dan peringkat di forum :)</p>
                <a href="#">Baca Panduan Diskusi</a>
            </div>
            <div class="discussion-list">
                @foreach($questions as $question)
                    <div class="discussion-item">
                        <div class="details">
                            <h5><a href="{{ route('questions.show', $question) }}">{{ $question->title }}</a></h5>
                            <p>{{ $question->user->name }} • {{ $question->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="meta">
                            <div class="views">{{ $question->views ?? 0 }}</div>
                            <div class="comments">{{ $question->answers->count() }}</div>
                            <span class="badge {{ $question->is_solved ? 'bg-success' : 'bg-secondary' }}">
                                {{ $question->is_solved ? 'Solved' : 'Unsolved' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $questions->links() }}
        </div>
        <div class="col-md-4">
            <div class="sidebar">
                <div class="nav flex-column">
                    <a href="{{ route('questions.index') }}" class="nav-link"><span class="nav-icon">📂</span> Semua Diskusi</a>
                    <a href="#" class="nav-link"><span class="nav-icon">🚀</span> Trending</a>
                    <a href="#" class="nav-link"><span class="nav-icon">⚡</span> Terpopuler</a>
                    <a href="#" class="nav-link"><span class="nav-icon">✔️</span> Selesai</a>
                    <a href="#" class="nav-link"><span class="nav-icon">🕒</span> Belum Selesai</a>
                    <a href="#" class="nav-link"><span class="nav-icon">❓</span> Belum Terjawab</a>
                </div>
                <div class="top-coder">
                    <h4>Top Coder</h4>
                    @foreach($topUsers as $user)
                        <div class="coder">
                            <img src="{{ $user->avatar ?? 'https://via.placeholder.com/40' }}" alt="{{ $user->name }}" width="40" height="40">
                            <span>{{ $user->name }} - {{ $user->points }} Point</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
