@extends('layouts.user')

@section('header')
    <style>
        /* Hero Section with Parallax Effect */
        #hero {
            background: url('{{ asset('user/images/cover.png') }}') top center;
            background-attachment: fixed;
            /* Keeps the image still while scrolling */
            background-repeat: no-repeat;
            width: 100%;
            background-size: cover;
            margin: 0px;
            height: 250px;
            /* Adjust the height as necessary */
        }

        /* Styling for the rest of the content */
        .full-img {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 180px;
        }

        .content {
            line-height: 1.6;
            font-size: 15px;
        }

        /* Adjustments for the section text */
        #call-to-action {
            background: #f4f4f4;
            padding: 50px 0;
        }

        .cta-title {
            font-size: 36px;
            font-weight: bold;
        }

        .cta-text {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .cta-btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cta-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 16px;
        }

        /* Card Styling */
        .card {
            min-height: 100%;
            /* Memastikan semua card memiliki tinggi penuh */
            display: flex;
            flex-direction: column;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            flex: 1;
            /* Membuat isi card fleksibel untuk menyesuaikan tinggi */
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        .card-text {
            font-size: 14px;
            color: #555;
        }

        .card-footer {
            background-color: #f8f8f8;
            text-align: center;
            padding: 10px;
        }

        .card-footer a {
            color: #28a745;
            text-decoration: none;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('hero')
    <h1>JELAJAHI DUNIA KULINER KAMI</h1>
@endsection

@section('content')
    <section id="articles" class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mt-5 mb-5">TENANT KAMI</h2>
            </div>
        </div>
        <div class="row">
            @if (empty($destinations) || $destinations->isEmpty())
                <div class="alert alert-warning col-md-12">
                    Tidak ada artikel yang tersedia saat ini.
                </div>
            @else
                @if (empty(request()->segment(2)))
                    @foreach ($destinations as $destination)
                        <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                            <div class="card">
                                @if ($destination->image)
                                    <img src="{{ asset('destinations_image/' . $destination->image) }}"
                                        alt="{{ $destination->title }}" class="card-img-top"
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/300x200" alt="Article Image" class="card-img-top"
                                        style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $destination->title }}</h5>
                                    <div class="card-text">
                                        @php
                                            $content = preg_replace([
                                                '/<a[^>]*><img[^>]*><\/a>/i', // Remove <a> tags containing <img>
                                                '/<img[^>]*>/i',              // Remove standalone <img> tags
                                                '/<p.*?>(.*?)<\/p>/si'        // Extract text inside <p> tags
                                            ], [
                                                '', // Replace <a> with <img> with nothing
                                                '', // Replace <img> with nothing
                                                '$1' // Extract only content inside <p>
                                            ], $destination->content);
                                        @endphp
                                        <p>{!! Str::limit($content, 725, ' . . .') !!}</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="/destination/{{ $destination->slug }}">Baca Detail</a>
                                </div>
                            </div>
                        </div> 
                    @endforeach   
                @else
                    @component('user.component.single_destination', ['destination'=> $destinations])
                    @endcomponent
                @endif
            @endif
        </div>
    </section>
@endsection
