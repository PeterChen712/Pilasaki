<!-- resources/views/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login - Forum Programmer')

@section('styles')
<style>
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .login-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
    .login-form .form-control {
        height: 45px;
        font-size: 16px;
    }
    .login-form .btn-primary {
        height: 45px;
        font-size: 16px;
    }
    .login-divider {
        text-align: center;
        margin: 20px 0;
        overflow: hidden;
    }
    .login-divider span {
        display: inline-block;
        position: relative;
    }
    .login-divider span:before,
    .login-divider span:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 100vw;
        height: 1px;
        background-color: #e0e0e0;
    }
    .login-divider span:before {
        right: 100%;
        margin-right: 15px;
    }
    .login-divider span:after {
        left: 100%;
        margin-left: 15px;
    }
    .btn-google {
        background-color: #4285F4;
        color: #ffffff;
    }
    .btn-google:hover {
        background-color: #357ae8;
        color: #ffffff;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <h2>Login</h2>
            <p>Selamat datang kembali di Forum Programmer</p>
        </div>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required autofocus>
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
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </form>
        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>
        <div class="text-center mt-2">
            Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
        </div>
    </div>
</div>
@endsection
