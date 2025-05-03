<!DOCTYPE html>
<html>
<head>
    <title>Register Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('front-end/img/carousel-2.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        .register-box {
            background-color: rgba(52, 58, 64, 0.9);
            border-radius: 15px;
            padding: 40px;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .form-control, .form-select {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-8">
        <div class="register-box">
            <h4 class="text-center mb-4">Register Pelanggan</h4>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="{{ old('nama_pelanggan') }}" required>
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                            <input type="password" name="kata_kunci" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                            <input type="text" name="no_telp" class="form-control" placeholder="No Telepon" value="{{ old('no_telp') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Foto (opsional)</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="alamat1" class="form-control" placeholder="Alamat" value="{{ old('alamat1') }}" required>
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-city"></i></span>
                            <input type="text" name="kota1" class="form-control" placeholder="Kota" value="{{ old('kota1') }}">
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-flag"></i></span>
                            <input type="text" name="propinsi1" class="form-control" placeholder="Provinsi" value="{{ old('propinsi1') }}">
                        </div>

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-mail-bulk"></i></span>
                            <input type="text" name="kodepos1" class="form-control" placeholder="Kode Pos" value="{{ old('kodepos1') }}">
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="btn btn-light w-100 py-2">Register</button>

                <div class="mt-3 text-center">
                    <small>Sudah punya akun? <a href="{{ route('login-pelanggan') }}" class="text-info">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
