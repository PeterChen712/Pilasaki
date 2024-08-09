<!-- resources/views/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register - Forum Programmer')

@section('content')
<div class="container">
    <div class="register-container">
        <div class="register-header">
            <h2>Register</h2>
            <p>Daftar untuk bergabung dengan Forum Programmer</p>
        </div>
        <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>
        <div class="text-center mt-3">
            Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
        </div>
    </div>
</div>
@endsection
