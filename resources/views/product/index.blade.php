@extends('fe.master')

@section('content')

  <!-- Breadcrumb Start -->
  <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Motor Kita</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active text-primary">Produk</li>
        </ol>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="container-fluid categories py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h1 class="text-4xl md:text-5xl font-extrabold text-sky-900 bg-gradient-to-r from-green-50 to-sky-100 px-6 py-4 rounded-xl shadow-md inline-block border border-sky-200">
                Jenis Motor
            </h1>
            <p class="mt-4 text-lg md:text-xl font-semibold text-gray-700 bg-gradient-to-r from-green-50 to-sky-100 px-6 py-3 rounded-xl shadow-sm inline-block border border-sky-200">
                Temukan berbagai jenis motor yang sesuai dengan kebutuhan dan gaya hidup Anda.
            </p>
        </div>

        @if ($motors->count() > 0)
            <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                @foreach ($motors as $motor)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden position-relative motor-card transition-all" style="transition: all 0.4s ease;">
                            <div class="overflow-hidden" style="height: 220px;">
                                <img src="{{ asset('storage/' . $motor->foto1) }}"
                                     alt="{{ $motor->nama_motor }}"
                                     class="img-fluid w-100 h-100 object-fit-cover rounded-top transition-transform"
                                     style="object-fit: cover; transition: transform 0.4s ease;">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between p-4 bg-white">
                                <div class="mb-3">
                                    <h5 class="card-title fw-semibold mb-2 text-dark" style="font-family: 'Poppins', sans-serif;">
                                        {{ $motor->nama_motor }}
                                    </h5>
                                    <h6 class="text-primary fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">
                                        Rp{{ number_format($motor->harga_jual, 0, ',', '.') }}
                                    </h6>
                                </div>
                                <a href="{{ route('motor.detail', ['id' => $motor->id]) }}"
                                   class="btn btn-outline-primary rounded-pill mt-auto fw-medium d-flex align-items-center justify-content-center gap-2 py-2 px-3 transition-all"
                                   style="font-size: 0.95rem;">
                                    <i class="fa fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <h5 class="text-muted" style="font-family: 'Poppins', sans-serif; font-size: 1rem;">
                    Tidak ada motor tersedia saat ini. Silakan cek kembali nanti.
                </h5>
            </div>
        @endif
    </div>
</div>

<style>
    .motor-card:hover img {
        transform: scale(1.05);
    }

    .motor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .motor-card .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>



<div class="container-fluid steps py-5 bg-secondary text-white">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize text-white mb-3 fw-semibold" style="font-family: 'Poppins', sans-serif;">
                Proses 3 Langkah Sederhana
            </h1>
            <p class="mb-0 text-light fs-5" style="font-family: 'Poppins', sans-serif;">
                Dapatkan motor impianmu dengan proses kredit mudah dalam tiga langkah!
            </p>
        </div>
        <div class="row g-4">
            <!-- Langkah 1 -->
            <div class="col-lg-4">
                <div class="bg-white text-dark rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-shadow transition"
                     style="transition: 0.3s ease-in-out;">
                    <div>
                        <div class="mb-3">
                            <div class="steps-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px; font-size: 1.2rem; font-weight: 600;">
                                01
                            </div>
                        </div>
                        <h4 class="fw-semibold" style="font-family: 'Poppins', sans-serif;">Hubungi Kami</h4>
                        <p class="text-muted" style="font-family: 'Poppins', sans-serif;">
                            Hubungi tim kami untuk mendapatkan informasi lengkap tentang motor yang ingin Anda beli.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Langkah 2 -->
            <div class="col-lg-4">
                <div class="bg-white text-dark rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-shadow transition"
                     style="transition: 0.3s ease-in-out;">
                    <div>
                        <div class="mb-3">
                            <div class="steps-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px; font-size: 1.2rem; font-weight: 600;">
                                02
                            </div>
                        </div>
                        <h4 class="fw-semibold" style="font-family: 'Poppins', sans-serif;">Pilih Motor</h4>
                        <p class="text-muted" style="font-family: 'Poppins', sans-serif;">
                            Pilih motor yang sesuai dengan kebutuhan Anda dari berbagai pilihan yang tersedia.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Langkah 3 -->
            <div class="col-lg-4">
                <div class="bg-white text-dark rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-shadow transition"
                     style="transition: 0.3s ease-in-out;">
                    <div>
                        <div class="mb-3">
                            <div class="steps-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px; font-size: 1.2rem; font-weight: 600;">
                                03
                            </div>
                        </div>
                        <h4 class="fw-semibold" style="font-family: 'Poppins', sans-serif;">Nikmati Berkendara</h4>
                        <p class="text-muted" style="font-family: 'Poppins', sans-serif;">
                            Proses kredit selesai dan Anda bisa langsung menikmati perjalanan dengan motor baru Anda!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
