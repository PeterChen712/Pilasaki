@extends('layouts.app')

@section('title', 'Register - Forum Programmer')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="register-container bg-white p-5 rounded shadow-lg" style="width: 100%; max-width: 400px;">
        <div class="register-header text-center mb-4">
            <h2 class="text-primary">Register</h2>
            <p class="text-muted">Daftar PISAH</p>
        </div>
        <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="password-requirements mt-2">
                    <ul class="list-unstyled">
                        <li id="length" class="text-danger">
                            <i class="fas fa-times"></i> Minimal 8 karakter
                        </li>
                        <li id="uppercase" class="text-danger">
                            <i class="fas fa-times"></i> Ada huruf kapital
                        </li>
                        <li id="lowercase" class="text-danger">
                            <i class="fas fa-times"></i> Ada huruf kecil
                        </li>
                        <li id="number" class="text-danger">
                            <i class="fas fa-times"></i> Ada angka
                        </li>
                        <li id="special" class="text-danger">
                            <i class="fas fa-times"></i> Ada karakter spesial
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </div>
        </form>
        <div class="text-center mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login disini</a>
        </div>
    </div>
</div>

<!-- Include Font Awesome for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Password Validation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const requirements = {
            length: document.getElementById('length'),
            uppercase: document.getElementById('uppercase'),
            lowercase: document.getElementById('lowercase'),
            number: document.getElementById('number'),
            special: document.getElementById('special')
        };

        const checkPassword = () => {
            const password = passwordInput.value;
            const criteria = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
            };

            for (const key in criteria) {
                if (criteria[key]) {
                    requirements[key].classList.remove('text-danger');
                    requirements[key].classList.add('text-success');
                    requirements[key].innerHTML = `<i class="fas fa-check"></i> ${requirements[key].textContent.trim()}`;
                } else {
                    requirements[key].classList.remove('text-success');
                    requirements[key].classList.add('text-danger');
                    requirements[key].innerHTML = `<i class="fas fa-times"></i> ${requirements[key].textContent.trim()}`;
                }
            }
        };

        passwordInput.addEventListener('input', checkPassword);
    });
</script>
@endsection
