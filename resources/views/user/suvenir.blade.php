@extends('layouts.user')

@section('header')
    <style>
        #hero {
            background: url('{{asset('user/images/cover.png')}}') top center;
            background-attachment: fixed; /* Keeps the image still while scrolling */
            background-repeat: no-repeat;
            width: 100%;
            background-size: cover;
            margin: 0px;
            height: 250px; /* Adjust the height as necessary */
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card h5 {
            font-size: 18px;
            margin: 10px 0;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .card .price {
            font-size: 16px;
            font-weight: bold;
            color: #f39c12;
        }

        .card a {
            display: inline-block;
            padding: 8px 16px;
            margin-top: 10px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .card a:hover {
            background-color: #2980b9;
        }

        .no-suvenir {
            background-color: #f9e38f; /* Yellow background */
            text-align: center;
            font-size: 18px;
            color: #888;
            padding: 50px 0;
            margin-top: 30px;
            border-radius: 10px;
        }

        .no-suvenir p {
            font-weight: bold;
        }
    </style>
@endsection

@section('hero')
    <h1>Daftar Suvenir Kami</h1>
    <h2>Asik</h2>
@endsection

@section('content')
    <!-- WhatsApp Floating Icon -->
    <a href="https://api.whatsapp.com/send?phone=6282139003999" target="_blank" class="whatsapp-icon">
        <i class="fa fa-whatsapp"></i>
    </a>

    <!-- Souvenir Cards Section -->
    <section id="suvenirs">
        <div class="container wow fadeIn">
            <div class="section-header">
                <h3 class="section-title">Suvenir Kami</h3>
                <p class="section-description">Temukan berbagai suvenir menarik kami di bawah ini:</p>
            </div>

            @if($suvenirs->isEmpty())
              <div class="alert alert-warning">
                Tidak ada artikel yang tersedia saat ini.
              </div>
            @else
                <div class="card-container">
                    @foreach($suvenirs as $suvenir)
                    <div class="card">
                        <img src="{{ asset('suvenirs_image/' . $suvenir->image) }}" alt="{{ $suvenir->name }}">
                        <h5>{{ $suvenir->name }}</h5>
                        <p>{!! $suvenir->short_description !!}</p>
                        <div class="price">Rp {{ number_format($suvenir->price, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Pagination Section -->
            <div class="pagination">
                {{ $suvenirs->links() }}
            </div>
        </div>
    </section>
@endsection
