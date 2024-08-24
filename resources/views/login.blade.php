@extends('layouts.app')

@section('title', 'Login Page')

@section('styles')
<style>
    body {
        background-image: url('{{ asset('images/login/bg1.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-color: #f4f7f6; /* fallback color */
        /* font-family: 'Nunito', sans-serif; */
    }

    .login-header img {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }

    .login-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .login-header img {
        max-width: 80px;
        margin-bottom: 15px;
    }
    .login-header h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333333;
    }
    .login-header p {
        font-size: 14px;
        color: #666666;
    }
    .login-form .form-group {
        margin-bottom: 25px;
    }
    .login-form .form-control {
        height: 50px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        box-shadow: none;
        transition: border-color 0.2s;
    }
    .login-form .form-control:focus {
        border-color: #007bff;
    }
    .login-form .input-group-append .input-group-text {
        background-color: #ffffff;
        border-radius: 0 5px 5px 0;
        border-color: #ced4da;
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: 0 15px; /* Sesuaikan padding agar pas */
        height: 50px; /* Sesuaikan tinggi dengan field password */
    }
    .login-form .btn-primary {
        height: 50px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 5px;
        background-color: #007bff;
        border-color: #007bff;
    }
    .login-form .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .login-divider {
        text-align: center;
        margin: 30px 0;
        position: relative;
    }
    .login-divider span {
        display: inline-block;
        position: relative;
        padding: 0 15px;
        font-size: 14px;
        color: #999999;
        background-color: #ffffff;
    }
    .login-divider:before,
    .login-divider:after {
        content: "";
        position: absolute;
        top: 50%;
        width: calc(50% - 30px);
        height: 1px;
        background-color: #e0e0e0;
    }
    .login-divider:before {
        left: 0;
    }
    .login-divider:after {
        right: 0;
    }
    .btn-google {
        background-color: #4285F4;
        color: #ffffff;
        height: 50px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 5px;
    }
    .btn-google:hover {
        background-color: #357ae8;
        color: #ffffff;
    }
    .text-center a {
        color: #007bff;
        text-decoration: none;
    }
    .text-center a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h2>Login</h2>
            <p>Selamat datang ke PISAH</p>
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
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
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
                <a href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>
        <div class="text-center mt-2">
            Tidak punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>
@endsection
