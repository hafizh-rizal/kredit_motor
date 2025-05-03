<!DOCTYPE html>
<html>
<head>
    <title>Login Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('front-end/img/car-1.png') }}">
    <style>
        body {
            background: url('{{ asset('front-end/img/garasi1.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        .login-box {
            background-color: rgba(52, 58, 64, 0.9); 
            border-radius: 15px;
            padding: 40px;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .form-control,
        .form-select {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="login-box">
            <h4 class="text-center mb-4">Login Pelanggan</h4>
            <form method="POST" action="{{ route('pelanggan.auth.login') }}">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
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
    </div>
</div>
</body>
</html>
