<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pelanggan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('front-end/img/car-1.png') }}">
    
    <style>
        body {
            background: url('{{ asset('front-end/img/g3.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            color: #fff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        }

        .form-control,
        .form-select {
            background-color: #fff;
            color: #000;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .btn-light:hover {
            background-color: #ddd;
        }

        .input-group-text {
            background-color: #eee;
        }

        a.text-info:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h4 class="text-center mb-4">Login Pelanggan</h4>
        <form method="POST" action="{{ route('pelanggan.auth.login') }}">
            @csrf

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="kata_kunci" class="form-control" placeholder="Password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-light w-100 py-2">Login</button>

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-3 text-center">
                <small>Belum punya akun? <a href="{{ route('pelanggan.auth.register') }}" class="text-info">Daftar di sini</a></small>
            </div>
        </form>
    </div>
</body>
</html>
