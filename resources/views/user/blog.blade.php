@extends('layouts.user')

@section('header')
    <style>
        #hero {
            background: url('{{ asset('user/images/cover.png') }}') top center;
            background-attachment: fixed; 
            background-repeat: no-repeat;
            width: 100%;
            background-size: cover;
            margin: 0px;
            height: 250px; 
        }

        .form-control:focus {
            box-shadow: none;
        }

        .form-control::placeholder {
            font-size: 0.95rem;
            color: #aaa;
            font-style: italic;
        }

        .article {
            line-height: 1.6;
            font-size: 15px;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-body {
            flex-grow: 1;
        }
    </style>    
@endsection

@section('hero')
    <h1>Artikel</h1>
@endsection

@section('content')  
  <!--========================== Menu Section ============================-->
  <section id="menu">
    <div class="container wow fadeIn">

      <div class="row">
        <div class="col-md-12">
          <h2 class="text-center mb-5 mt-5"></h2>
        </div>
      </div>

      <div class="row">
        <div class="col-9">
          @if($articles && $articles->count() > 0)
            <div class="row">
              @foreach($articles as $article)
                <div class="col-md-6 mb-4">
                  <div class="card h-100 shadow-sm">
                    <div class="card-body">
                      @component('user.component.single_blog', ['article' => $article])
                      @endcomponent
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="col-md-12">
              <div class="alert alert-warning">
                Tidak ada artikel yang tersedia saat ini.
              </div>
            </div>
          @endif
        </div>
        
        <div class="col-3">
            <form action="{{ route('blog') }}" class="mt-5">
              <div class="input-group mb-4 border rounded-pill shadow-lg" style="border-radius:10px; box-shadow: 3px 3px 8px grey;">
                <input type="text" name="s" value="{{ Request::get('s') }}" placeholder="Apa yang ingin anda cari?" class="form-control bg-none border-0" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                <div class="input-group-append border-0">
                  <button type="submit" class="btn text-success"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>

            <div class="mb-3 font-weight-bold">Recent Posts</div>
            @foreach ($recents as $recent)
              <div>
                <a href="{{ route('blog.show', [$recent->slug]) }}"> 
                  <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                  {{ $recent->title }}
                </a>
                <hr>
              </div>
            @endforeach
        </div>
      </div>

    </div>
  </section><!-- #menu -->
@endsection
