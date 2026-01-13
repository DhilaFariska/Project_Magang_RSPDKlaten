@extends('layouts.auth')

@section('title', 'Login Admin Panel RSPD Klaten')

@section('content')
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-12">
            <div class="card auth-card">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <a href="{{ route('home') }}" class="text-white text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                    <div class="text-center mb-3">
                        <div class="shield-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </div>
                    <h2 class="text-center fw-bold mb-2">Admin Panel RSPD Klaten</h2>
                    <p class="text-center text-muted mb-2">Masuk untuk mengakses panel administrasi</p>
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Masukkan email" required autofocus>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password" required>
                            <span class="password-toggle" onclick="togglePassword()">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-4">Masuk</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-2 text-muted">
                <span>&copy; {{ date('Y') }} Radio Siaran Pemerintah Daerah Klaten</span><br>
                <span>Panel Administrasi Sistem</span>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ Session::get('error') }}',
                    timer: 3000,
                    showConfirmButton: true
                });
            @endif

            @if (Session::has('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: '{{ Session::get('info') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: `
                    <ul class="text-start">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                    showConfirmButton: true
                });
            @endif
        });
    </script>
@endsection
