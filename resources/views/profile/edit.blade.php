@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profil') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        {{-- Form Edit Nama --}}
                        <div class="form-group">
                            <label for="name">{{ __('Nama') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        {{-- Form Edit Email --}}
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Form Edit Avatar --}}
                        <div class="form-group">
                            <label for="avatar">{{ __('Avatar') }}</label>
                            <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group" id="avatar-crop-container" style="display: none;">
                            <img id="avatar-image" src="#" alt="Avatar to crop" style="max-width: 100%;">
                        </div>
                    
                        <input type="hidden" id="cropped-avatar" name="cropped_avatar">

                        {{-- Form Edit Bio --}}
                        <div class="form-group">
                            <label for="bio">{{ __('Bio') }}</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        {{-- Form Edit Points (optional, hidden if not for admin) --}}
                        @if(auth()->user()->is_admin)
                        <div class="form-group">
                            <label for="points">{{ __('Points') }}</label>
                            <input type="number" class="form-control @error('points') is-invalid @enderror" id="points" name="points" value="{{ old('points', $user->points) }}">
                            @error('points')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @endif

                        {{-- Form Edit Password --}}
                        <div class="form-group">
                            <label for="current_password">{{ __('Password Saat Ini') }}</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="password">{{ __('Password Baru') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Konfirmasi Password') }}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/1.5.12/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const avatarInput = document.getElementById('avatar');
    const avatarImage = document.getElementById('avatar-image');
    const avatarCropContainer = document.getElementById('avatar-crop-container');
    const croppedAvatarInput = document.getElementById('cropped-avatar');
    let cropper;

    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    avatarImage.src = event.target.result;
                    avatarCropContainer.style.display = 'block';

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(avatarImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        minCropBoxWidth: 200,
                        minCropBoxHeight: 200,
                        ready: function() {
                            this.cropper.crop();
                        }
                    });
                };

                reader.readAsDataURL(file);
            }
        });
    }

    // Tambahkan event listener untuk form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (cropper) {
            croppedAvatarInput.value = cropper.getCroppedCanvas().toDataURL('image/jpeg');
        }
        this.submit();
    });
});
</script>
@endsection
