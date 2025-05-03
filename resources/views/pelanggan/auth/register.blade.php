<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('front-end/img/car-1.png') }}">
    <style>
        body {
            background: url('{{ asset('front-end/img/g2.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-box {
            background-color: rgba(52, 58, 64, 0.9);
            border-radius: 15px;
            padding: 40px;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 900px;
            overflow-y: auto; /* Enable scrolling if content exceeds height */
            max-height: 90vh; /* Limit maximum height */
        }
        .form-control, .form-select {
            background-color: #f8f9fa;
        }
        @media (min-width: 768px) {
            .register-box {
                width: 60%;
            }
        }
        @media (max-width: 767px) {
            .register-box {
                width: 90%;
            }
        }
        h4 {
            font-size: 1.8rem;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="register-box">
            <h4 class="text-center mb-4">Register Pelanggan</h4>
            <form method="POST" action="{{ route('pelanggan.auth.register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Side -->
                    <div class="col-md-6">
                        <!-- Nama -->
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="{{ old('nama_pelanggan') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        <!-- Kata sandi -->
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                            <input type="password" name="kata_kunci" class="form-control" placeholder="Password" required>
                        </div>

                        <!-- Konfirmasi kata sandi -->
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                            <input type="password" name="kata_kunci_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>

                        <!-- No Telepon -->
                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                            <input type="text" name="no_telp" class="form-control" placeholder="No Telepon" value="{{ old('no_telp') }}" required>
                        </div>

                        <!-- Upload Foto -->
                        <div class="mb-3">
                            <label>Foto (opsional)</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-6">
                        <h6 class="text-light">Alamat Utama</h6>
                        <div class="mb-2">
                            <input type="text" name="alamat1" class="form-control" placeholder="Alamat 1" value="{{ old('alamat1') }}" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="kota1" class="form-control" placeholder="Kota 1" value="{{ old('kota1') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="propinsi1" class="form-control" placeholder="Provinsi 1" value="{{ old('propinsi1') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="kodepos1" class="form-control" placeholder="Kode Pos 1" value="{{ old('kodepos1') }}">
                        </div>

                        <hr class="text-light">

                        <h6 class="text-light">Alamat Alternatif 2 (opsional)</h6>
                        <div class="mb-2">
                            <input type="text" name="alamat2" class="form-control" placeholder="Alamat 2" value="{{ old('alamat2') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="kota2" class="form-control" placeholder="Kota 2" value="{{ old('kota2') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="propinsi2" class="form-control" placeholder="Provinsi 2" value="{{ old('propinsi2') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="kodepos2" class="form-control" placeholder="Kode Pos 2" value="{{ old('kodepos2') }}">
                        </div>

                        <hr class="text-light">

                        <h6 class="text-light">Alamat Alternatif 3 (opsional)</h6>
                        <div class="mb-2">
                            <input type="text" name="alamat3" class="form-control" placeholder="Alamat 3" value="{{ old('alamat3') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="kota3" class="form-control" placeholder="Kota 3" value="{{ old('kota3') }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="propinsi3" class="form-control" placeholder="Provinsi 3" value="{{ old('propinsi3') }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="kodepos3" class="form-control" placeholder="Kode Pos 3" value="{{ old('kodepos3') }}">
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="btn btn-light w-100 py-2" href="{{route('pelanggan.index')}}">Register</button>

                <div class="mt-3 text-center">
                    <small>Sudah punya akun? <a href="{{ route('pelanggan.auth.login') }}" class="text-info">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
