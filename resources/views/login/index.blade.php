@extends('be.master')

@section('content')
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="login-card card" style="max-width: 450px; width: 100%;">
            <div class="card-block">
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <h3 class="text-center text-primary">Sign In</h3>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center">
                        <img src="{{ asset('back-end/images/logo.png') }}" alt="logo" class="img-fluid" style="max-width: 150px; margin-bottom: 20px;">
                    </div>
                    <hr/>
                    @if (session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-group form-primary">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email Address" required>
                        <span class="form-bar"></span>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group form-primary">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                        <span class="form-bar"></span>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign In</button>
                        </div>
                    </div>
                    <hr/>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto text-center">
                            <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
                            <p class="text-inverse text-left"><strong class="font-weight-bold">Your Authentication Team</strong></p>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('back-end/images/auth/Logo-small-bottom.png') }}" alt="small-logo" class="img-fluid" style="max-width: 80px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .login {
        position: fixed; /* Membuat section login selalu menutupi viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom right, #007bff, #6610f2); /* Contoh background gradient */
        overflow: auto; /* Jika konten melebihi layar */
    }

    .login-card {
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* Tidak perlu lagi mengatur max-width dan width di sini, kita atur di container */
    }

    .container-fluid {
        display: flex;
        align-items: center; /* Pusatkan vertikal */
        justify-content: center; /* Pusatkan horizontal */
        min-height: 100vh; /* Pastikan container setidaknya setinggi viewport */
        padding: 20px; /* Berikan sedikit ruang di tepi layar */
    }

    .card {
        width: 100%;
        max-width: 450px; /* Tetapkan lebar maksimum card */
    }

    .card-block {
        padding: 30px; /* Berikan padding di dalam card */
    }

    .row.m-b-20 {
        margin-bottom: 20px;
    }

    .text-center.text-primary h3 {
        margin-top: 0; /* Hilangkan margin atas default heading */
        margin-bottom: 20px; /* Berikan jarak ke elemen berikutnya */
    }

    .text-center img.img-fluid {
        max-width: 150px;
        margin-bottom: 20px;
    }

    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .form-group.form-primary {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group.form-primary input.form-control {
        border: none;
        border-bottom: 1px solid #9e9e9e;
        border-radius: 0;
        padding: 8px 0;
        font-size: 1rem;
        color: #333;
        background-color: transparent;
        box-shadow: none;
    }

    .form-group.form-primary input.form-control:focus {
        border-bottom-color: #007bff;
        box-shadow: none;
    }

    .form-group.form-primary span.form-bar {
        position: absolute;
        left: 0;
        bottom: 0;
        background: #007bff;
        width: 0%;
        height: 2px;
    }

    .form-group.form-primary input.form-control:focus ~ .form-bar {
        width: 100%;
        transition: width 0.4s ease-in-out;
    }

    .text-danger small {
        display: block;
        margin-top: 5px;
    }

    .row.m-t-30 {
        margin-top: 30px;
    }

    .btn.btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        border-radius: 5px;
        padding: 12px 20px;
        font-size: 1rem;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .btn.btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .row.align-items-center.justify-content-center {
        margin-top: 20px;
    }

    .text-inverse {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .font-weight-bold {
        font-weight: bold;
    }

    .col-auto img.img-fluid {
        max-width: 80px;
    }
</style>