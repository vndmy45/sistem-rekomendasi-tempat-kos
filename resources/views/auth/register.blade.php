<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RumahKost</title>
    <!-- Logo Title -->
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #71B4F3;
        }
        .card {
            border-radius: 15px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
        }
        .btn-primary {
            background-color: #71B4F3;
            border: none;
            padding: 12px;
            border-radius: 8px;
        }
        .auth-link {
            color: #71B4F3;
            text-decoration: none;
        }
        .auth-link:hover {
            color: #5a91c4;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="text-center text-white mb-4">
                    <div class="mb-4">
                        <i class="fas fa-user-plus fa-5x"></i>
                    </div>
                    <h1 class="fw-bold mb-5">REGISTER</h1>
                </div>
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4" style="color: #71B4F3">Buat Akun Baru</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" name="name" placeholder="Masukkan Nama Lengkap" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" placeholder="Masukkan Email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <input type="password" class="form-control form-control-lg" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Konfirmasi Kata Sandi" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 mb-3">Register</button>
                            <div class="text-center">
                                <span class="text-muted">Sudah punya akun?</span>
                                <a href="{{ route('login') }}" class="auth-link">Masuk</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 