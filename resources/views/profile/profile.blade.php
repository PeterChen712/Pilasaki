@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if(isset($user))
                        <div class="text-center mb-4">
                            <img src="{{ $user->avatar ?? 'https://via.placeholder.com/150' }}" alt="{{ $user->name }}" class="rounded-circle" width="150" height="150">
                            <h2 class="mt-2">{{ $user->name }}</h2>
                            <p>{{ $user->bio ?? 'No bio available' }}</p>
                            <p>Member since {{ $user->created_at->diffForHumans() }}</p>
                        </div>

                        <div class="row text-center mb-4">
                            <div class="col-md-4">
                                <h3>{{ $user->points ?? 0 }}</h3>
                                <p>Points</p>
                            </div>
                            <div class="col-md-4">
                                <h3>{{ $user->contributions_count ?? 0 }}</h3>
                                <p>Contributions</p>
                            </div>
                            <div class="col-md-4">
                                <h3>{{ $user->best_answers_count ?? 0 }}</h3>
                                <p>Best Answers</p>
                            </div>
                        </div>

                        @if(isset($activities) && count($activities) > 0)
                            <h3>Recent Activities</h3>
                            @foreach($activities as $activity)
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ $activity->user->avatar ?? 'https://via.placeholder.com/50' }}" alt="{{ $activity->user->name }}" class="rounded-circle mr-2" width="50" height="50">
                                    <p class="mb-0">{{ $activity->description }}</p>
                                </div>
                            @endforeach
                        @else
                            <p>No recent activities.</p>
                        @endif
                    @else
                        <p>User not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection