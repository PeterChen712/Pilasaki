@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Notifikasi</h1>
    @if($notifications->isEmpty())
        <p>Tidak ada notifikasi.</p>
    @else
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item {{ $notification->is_read ? 'list-group-item-secondary' : 'list-group-item-primary' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>
                                <a href="{{ route('diskusi.questions.show', $notification->related_question_id) }}">
                                    {{ $notification->title }}
                                </a>
                            </h5>
                            <p>{{ $notification->message }}</p>
                            <small>
                                @if($notification->created_at instanceof \Carbon\Carbon)
                                    {{ $notification->created_at->diffForHumans() }}
                                @else
                                    {{ $notification->created_at }}
                                @endif
                            </small>
                        </div>
                        <div class="btn-group">
                            @if(!$notification->is_read)
                                <form method="POST" action="{{ route('notifications.markAsRead', ['notification' => $notification->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Tandai telah dibaca">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('notifications.destroy', ['notification' => $notification->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection
