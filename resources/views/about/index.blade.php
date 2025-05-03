@extends('fe.master')
@section('content')

<!-- About Start -->
<div class="container-fluid overflow-hidden about py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-item">
                    <div class="pb-5" style="background-color: rgba(0, 0, 0, 0.05); padding: 20px; border-radius: 10px;">
                        <h1 class="display-5 text-capitalize" style="color: #212529;">HRide <span class="text-primary">About Us</span></h1>
                        <p class="mb-0" style="color: #6c757d;">
                            Kami adalah penyedia layanan kredit motor yang berdedikasi untuk memberikan kemudahan dan kenyamanan bagi pelanggan dalam memiliki kendaraan impian. Dengan berbagai pilihan motor terbaru dan sistem cicilan yang fleksibel, kami siap membantu Anda mewujudkan keinginan untuk memiliki motor dengan cara yang mudah, cepat, dan terpercaya.
                        </p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="about-item-inner border p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                                <div class="about-icon mb-4">
                                    <img src="{{ asset('front-end/img/about-icon-1.png') }}" class="img-fluid w-50 h-50" alt="Icon">
                                </div>
                                <h5 class="mb-3" style="color: #212529;">Visi Kami</h5>
                                <p class="mb-0" style="color: #6c757d;">
                                    Menjadi penyedia layanan kredit motor terpercaya yang memberikan solusi terbaik bagi pelanggan, dengan pelayanan yang cepat, aman, dan terpercaya.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-item-inner border p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                                <div class="about-icon mb-4">
                                    <img src="{{ asset('front-end/img/about-icon-2.png') }}" class="img-fluid h-50 w-50" alt="Icon">
                                </div>
                                <h5 class="mb-3" style="color: #212529;">Misi Kami</h5>
                                <p class="mb-0" style="color: #6c757d;">
                                    Kami bertujuan untuk menyediakan berbagai pilihan motor dengan harga yang terjangkau dan kemudahan dalam proses pengajuan kredit, serta memberikan pengalaman terbaik dalam memiliki kendaraan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="text-item my-4" style="color: #6c757d;">
                        Kami memahami bahwa setiap orang memiliki kebutuhan dan keinginan yang berbeda dalam memiliki kendaraan. Oleh karena itu, kami menawarkan berbagai jenis motor dengan pilihan cicilan yang disesuaikan dengan kemampuan finansial pelanggan. Proses pengajuan kredit yang mudah, transparansi dalam informasi, serta pelayanan pelanggan yang responsif adalah prioritas utama kami.
                    </p>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="text-center rounded bg-secondary p-4">
                                <h1 class="display-6 text-white">10</h1>
                                <h5 class="text-light mb-0">Tahun Pengalaman</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="rounded" style="background-color: rgba(255, 255, 255, 0.8); padding: 10px; border-radius: 10px;">
                                <p class="mb-2" style="color: #212529;"><i class="fa fa-check-circle text-primary me-1"></i> Proses pengajuan yang mudah dan cepat</p>
                                <p class="mb-2" style="color: #212529;"><i class="fa fa-check-circle text-primary me-1"></i> Cicilan fleksibel sesuai kemampuan</p>
                                <p class="mb-2" style="color: #212529;"><i class="fa fa-check-circle text-primary me-1"></i> Pilihan motor terbaru dan berkualitas</p>
                                <p class="mb-0" style="color: #212529;"><i class="fa fa-check-circle text-primary me-1"></i> Pelayanan pelanggan yang ramah dan profesional</p>
                            </div>
                        </div>
                        <div class="col-lg-5 d-flex align-items-center">
                            <a href="#" class="btn btn-primary rounded py-3 px-5">Lebih Lanjut Tentang Kami</a>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('front-end/img/attachment-img.jpg') }}" class="img-fluid rounded-circle border border-4 border-secondary" style="width: 100px; height: 100px;" alt="Image">
                                <div class="ms-4">
                                    <h4 style="color: #212529;">John Doe</h4>
                                    <p class="mb-0" style="color: #6c757d;">CEO Carveo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="about-img">
                    <div class="img-1">
                        <img src="{{ asset('front-end/img/about-img.jpg') }}" class="img-fluid rounded h-100 w-100" alt="">
                    </div>
                    <div class="img-2">
                        <img src="{{ asset('front-end/img/about-img-1.jpg') }}" class="img-fluid rounded w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About End -->

@endsection
