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

    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(20, 20, 20, 0.6), rgba(20, 20, 20, 0.6)),
                        url('{{ asset('front-end/img/g3.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    .login-box {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 400px;
      color: #f8f9fa;
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h4 {
      font-weight: 600;
      margin-bottom: 24px;
      text-align: center;
    }

    .input-group-text {
      background-color: rgba(255, 255, 255, 0.15);
      border: none;
      color: #ffffff;
      border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
      border: none;
      border-left: 1px solid rgba(255, 255, 255, 0.1);
    }

    .form-control::placeholder {
      color: #ccc;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
      box-shadow: none;
    }

    .btn-login {
      background-color: #ff6600;
      border: none;
      font-weight: 600;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background-color: #e65c00;
    }

    .form-text a {
      color: #ffb347;
      text-decoration: none;
    }

    .form-text a:hover {
      text-decoration: underline;
    }

    .alert {
      font-size: 14px;
      margin-top: 15px;
    }

    label {
      color: #e0e0e0;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h4>Login Pelanggan</h4>
    <form method="POST" action="{{ route('pelanggan.auth.login') }}">
      @csrf

      <div class="mb-3">
        <label>Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Masukkan email" required autofocus>
        </div>
      </div>

      <div class="mb-3">
        <label>Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" name="kata_kunci" class="form-control" placeholder="Masukkan kata sandi" required>
        </div>
      </div>

      <button type="submit" class="btn btn-login w-100 py-2 mt-2">Masuk</button>

      @if($errors->any())
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
      @endif

      @if(session('pesan'))
        <div class="alert alert-success">
          {{ session('pesan') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <div class="form-text text-center mt-3">
        Belum punya akun? <a href="{{ route('pelanggan.auth.register') }}">Daftar di sini</a>
      </div>
    </form>
  </div>
</body>
</html>
