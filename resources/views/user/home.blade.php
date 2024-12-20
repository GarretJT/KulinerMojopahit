@extends('layouts.user')

@section('header')
    <style>
        /* General Styles */
        .full-img {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .row .col-lg-3, .col-md-4, .col-sm-6 {
            padding: 10px;
        }

        .image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 8px;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Hero Section */
        #hero {
            background: url('{{asset('user/images/cover.png')}}') top center;
        }

        .image-center {
            display: block;
            margin-left: 6.5px;
            margin-right: 6.5px;
            width: 100%;
        }

        /* WhatsApp Icon */
        .whatsapp-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }

        .whatsapp-icon i {
            color: white;
            font-size: 24px;
        }

        .whatsapp-icon:hover {
            background-color: #128C7E;
        }

        /* Mobile Optimization */
        @media (max-width: 768px) {
            .full-img {
                height: 150px;
            }
        }
    </style>
@endsection

@section('hero')
    <h2>TEMUKAN CITA RASA KHAS SURABAYA</h2>
    <h1>JELAJAHI DUNIA KULINER KAMI</h1>
    <h2>BUKA SETIAP HARI PK. 08:00 - 16.30</h2>
    <a href="/suvenir" class="btn-get-started">Suvenir Kami</a>
@endsection

@section('content')

<!-- About Us Section -->
<section id="about">
    <div class="container">
        <div class="row about-container">
            @if($about->isNotEmpty()) 
                <div class="col-lg-7 content order-lg-1 order-2">
                    <h2 class="title">Tentang Kami</h2>
                    <p>{!! $about[0]->caption !!}</p>
                </div>

                <div class="col-lg-5 background order-lg-2 order-1 wow fadeInRight" 
                    style="background: url('{{ asset('about_image/'.$about[0]->image) }}') center top no-repeat; background-size: cover;">
                </div>
            @else
                <div class="col-lg-7 content order-lg-1 order-2">
                    <h2 class="title">Tentang Kami</h2>
                    <div class="alert alert-warning">
                      Tidak ada deskripsi yang tersedia saat ini.
                    </div>
                </div>
                <div class="col-lg-5 background order-lg-2 order-1 wow fadeInRight" 
                    style="background: url('{{ asset('user/images/default-image.jpg') }}') center top no-repeat; background-size: cover;">
                </div>
            @endif
        </div>
    </div>
</section>

<!-- WhatsApp Floating Icon -->
<a href="https://api.whatsapp.com/send?phone=6282139003999" target="_blank" class="whatsapp-icon">
    <i class="fa fa-whatsapp"></i>
</a>

<!-- Google Maps Section -->
<section id="google-maps">
    <div class="container wow fadeIn">
        <div class="section-header">
            <h3 class="section-title">Lokasi Kami</h3>
            <p class="section-description">Temukan kami di alamat berikut:</p>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1757687726936!2d112.36837327500268!3d-7.55580509245799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e786d07706e5635%3A0x13e557c51ff9348!2sKuliner%20Maha%20Vihara%20Mojopahit!5e0!3m2!1sen!2sid!4v1734451840517!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="contact" style="padding-bottom:85px">
    <div class="container wow fadeInUp">
        <div class="section-header">
            <h3 class="section-title">Galeri</h3>
            <p class="section-description">Inilah Kisah Kita</p>
        </div>
    </div>

    <div class="container wow fadeInUp">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-4">
                <div class="row">
                    @foreach ($galleries as $gallery)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="full-img" 
                                style="background-image: url('{{ asset('gallery_images/' . $gallery->image) }}');">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
