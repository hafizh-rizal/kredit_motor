@extends('fe.master')

@section('content')

  <!-- Breadcrumb Start -->
  <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Product Categories</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active text-primary">Categories</li>
        </ol>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="container-fluid categories py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h1 class="display-6 text-capitalize mb-2" style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #0c4a6e; background-image: linear-gradient(to right, #f0fdf4, #e0f2fe); padding: 10px 20px; border-radius: 10px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); display: inline-block; border: 1px solid #e0f2fe;">
                Our Vehicle Categories
            </h1>
            <p class="mb-0 text-muted" style="font-family: 'Poppins', sans-serif; font-size: 1rem; color: #374151; background-image: linear-gradient(to right, #f0fdf4, #e0f2fe); padding: 10px 20px; border-radius: 10px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); display: inline-block; border: 1px solid #e0f2fe;">
                Explore a variety of vehicles and find the perfect one for you. We offer a wide selection to meet your needs.
            </p>
        </div>

        @if ($motors->count() > 0)
            <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                @foreach ($motors as $motor)
                    <div class="col-lg-4 col-md-6 h-auto mb-4">
                        <div class="categories-item bg-white rounded-3 shadow-sm h-100 d-flex flex-column transition-all duration-300 hover:shadow-lg">
                            <div class="categories-img rounded-top overflow-hidden">
                                <img src="{{ asset('storage/' . $motor->foto1) }}" class="img-fluid w-100 rounded-top transition-all duration-300" alt="{{ $motor->nama_motor }}" style="height: 220px; object-fit: cover;">
                            </div>
                            <div class="categories-content rounded-bottom p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h4 class="text-dark mb-2" style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.1rem;">{{ $motor->nama_motor }}</h4>
                                    <div class="categories-review mb-3">
                                        <div class="d-flex align-items-center justify-content-center">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < 4)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="fas fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2 text-muted" style="font-family: 'Poppins', sans-serif; font-size: 0.85rem;">4.5 Review(s)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                       <h4 class="text-primary py-2 px-3 mb-0" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem;">
                                            Rp{{ number_format($motor->harga_jual, 0, ',', '.') }}
                                        </h4>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('motor.detail', ['id' => $motor->id]) }}"
                                        class="btn btn-primary rounded-pill d-flex justify-content-center py-2 transition-all duration-300"
                                        style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 0.9rem;">
                                        <i class="fa fa-eye me-2"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                 <h5 class="text-muted" style="font-family: 'Poppins', sans-serif; font-size: 1rem;">No vehicles available at the moment. Please check back later.</h5>
            </div>
        @endif
    </div>
</div>
<div class="container-fluid steps py-5 bg-secondary text-white">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize text-white mb-3" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Proses 3 Langkah Sederhana</h1>
            <p class="mb-0 text-light" style="font-family: 'Poppins', sans-serif; font-size: 1.1rem;">
                Dapatkan motor impianmu dengan proses kredit mudah dalam tiga langkah!
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="steps-item bg-white rounded-3 text-dark p-4 mb-4 transition-all duration-300 hover:shadow-lg h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="text-dark" style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.2rem;">Hubungi Kami</h4>
                        <p class="mb-0 text-muted" style="font-family: 'Poppins', sans-serif; font-size: 0.95rem;">Hubungi tim kami untuk mendapatkan informasi lengkap tentang motor yang ingin Anda beli.</p>
                    </div>
                    <div class="steps-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="font-family: 'Poppins', sans-serif;">
                        01.
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="steps-item bg-white rounded-3 text-dark p-4 mb-4 transition-all duration-300 hover:shadow-lg h-100 d-flex flex-column justify-content-between">
                     <div>
                        <h4 class="text-dark" style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.2rem;">Pilih Motor</h4>
                        <p class="mb-0 text-muted" style="font-family: 'Poppins', sans-serif; font-size: 0.95rem;">Pilih motor yang sesuai dengan kebutuhan Anda dari berbagai pilihan yang tersedia.</p>
                     </div>
                    <div class="steps-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="font-family: 'Poppins', sans-serif;">
                        02.
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="steps-item bg-white rounded-3 text-dark p-4 mb-4 transition-all duration-300 hover:shadow-lg h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="text-dark" style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.2rem;">Nikmati Berkendara</h4>
                        <p class="mb-0 text-muted" style="font-family: 'Poppins', sans-serif; font-size: 0.95rem;">Proses kredit selesai dan Anda bisa langsung menikmati perjalanan dengan motor baru Anda!</p>
                    </div>
                    <div class="steps-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="font-family: 'Poppins', sans-serif;">
                        03.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
