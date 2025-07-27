<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Pelanggan</title>
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


    .register-box {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 40px;
      max-width: 900px;
      width: 100%;
      color: #f1f1f1;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
    }

    h4 {
      font-weight: 600;
      color: #ffffff;
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-control::placeholder {
      color: #ccc;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      border-color: #0d6efd;
      color: #fff;
      box-shadow: none;
    }

    .input-group-text {
      background-color: rgba(255, 255, 255, 0.15);
      border: none;
      color: #fff;
      border-radius: 10px 0 0 10px;
    }

    .btn-register {
      background-color: #0d6efd;
      border: none;
      color: white;
      font-weight: 500;
      border-radius: 8px;
      transition: 0.3s ease;
    }

    .btn-register:hover {
      background-color: #0b5ed7;
    }

    .link-login {
      color: #0d6efd;
      text-decoration: none;
    }

    .link-login:hover {
      text-decoration: underline;
    }

    .alert {
      border-radius: 8px;
      padding: 10px 15px;
      margin-top: 15px;
    }

    label {
      color: #ddd;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="register-box">
    <h4 class="text-center mb-4">Register Pelanggan</h4>
    <form method="POST" action="{{ route('pelanggan.auth.register') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- Left -->
        <div class="col-md-6">
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="{{ old('nama_pelanggan') }}" required>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="kata_kunci" class="form-control" placeholder="Password" required>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="kata_kunci_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
          </div>

          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
            <input type="text" name="no_telp" class="form-control" placeholder="No Telepon" value="{{ old('no_telp') }}" required>
          </div>

          <div class="mb-3">
            <label>Upload Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
          </div>
        </div>

        <!-- Right -->
        <div class="col-md-6">
          <h6 class="mb-2">Alamat Utama</h6>
          <div class="mb-2">
            <input type="text" name="alamat1" class="form-control" placeholder="Alamat" value="{{ old('alamat1') }}" required>
          </div>
          <div class="mb-2">
            <input type="text" name="kota1" class="form-control" placeholder="Kota" value="{{ old('kota1') }}">
          </div>
          <div class="mb-2">
            <input type="text" name="propinsi1" class="form-control" placeholder="Provinsi" value="{{ old('propinsi1') }}">
          </div>
          <div class="mb-3">
            <input type="text" name="kodepos1" class="form-control" placeholder="Kode Pos" value="{{ old('kodepos1') }}">
          </div>
        </div>
      </div>

      {{-- Pesan --}}
      @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
      @endif

      @if(session('pesan'))
      <div class="alert alert-success">{{ session('pesan') }}</div>
      @endif

      @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <button type="submit" class="btn btn-register w-100 py-2 mt-2">Register</button>

      <div class="text-center mt-3">
        <small>Sudah punya akun? <a href="{{ route('pelanggan.auth.login') }}" class="link-login">Login di sini</a></small>
      </div>
    </form>
  </div>
</body>
</html>
