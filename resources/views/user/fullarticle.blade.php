@extends('layouts.user')

@section('header')
    <style>
        /* Styling for the article page */
        .article-content {
            line-height: 1.8;
            font-size: 16px;
            margin-top: 20px;
        }
        .article-title {
            font-size: 36px;
            font-weight: bold;
        }
        .article-body {
            margin-top: 20px;
        }
    </style>
@endsection

@section('hero')
    <h1>Artikel Lengkap</h1>
@endsection

@section('content')
    <div class="container">
        <div class="article-content">
            <h2 class="article-title">{{ $article->title }}</h2>
            <div class="article-body">
                <p>{{ $article->content }}</p> <!-- Menampilkan konten lengkap artikel -->
            </div>
        </div>
    </div>
@endsection
