@extends('layouts.user')

@section('header')
    <style>
        #hero {
            background: url('{{ asset('user/images/cover.png') }}') top center;
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

        .no-menu {
            background-color: #f9e38f; /* Yellow background */
            text-align: center;
            font-size: 18px;
            color: #888;
            padding: 50px 0;
            margin-top: 30px;
            border-radius: 10px;
        }

        .no-menu p {
            font-weight: bold;
        }
    </style>
@endsection

@section('hero')
    <h1>Menu {{ $tenant->title }}</h1>
@endsection

@section('content')
    <!-- Menu Cards Section -->
    <section id="menus">
        <div class="container wow fadeIn">
            <div class="section-header">
                <h3 class="section-title mt-5">Menu Kami</h3>
                <p class="section-description">Temukan berbagai menu menarik kami di bawah ini:</p>
            </div>

            @if($menus->isEmpty())
                <div class="alert alert-warning">
                    Tidak ada menu yang tersedia saat ini.
                </div>
            @else
                <div class="card-container">
                    @foreach($menus as $menu)
                        <div class="card">
                            @if ($menu->image)
                                <img src="{{ asset('menus_image/' . $menu->image) }}" alt="{{ $menu->name }}">
                            @else
                                <img src="https://via.placeholder.com/400x300" alt="Menu Image">
                            @endif
                            <h5>{{ $menu->name }}</h5>
                            <p>{!! $menu->description !!}</p>
                            <div class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
