@if (count($articles) != 0)
<div class="row">
  @foreach ($articles as $article)
    <div class="col-md-4 card mb-4 mx-2" style="max-width: 18rem;">
      <div class="card-body">
        <a href="{{route('blog.show', [$article->slug])}}" class="decoration-none">
          <h5 class="card-title">
            {{$article->title}}
          </h5>
        </a>
        <div class="card-meta">
          <div class="mt-1">
            <small class="font-italic">Created At : {{date('d M Y', strtotime($article->created_at))}} |</small>
            @foreach($article->categories as $value)
                <a class="d-inline underline" href="{{route('blog', ['c' =>$value->name])}}">
                    <small class="font-italic">
                      {{$value->name}},
                    </small>
                </a>
            @endforeach
          </div>
        </div>
        <div class="card-text">
            @php
              // Extract only the paragraph text without tags
              $content = preg_replace([
                '/<a[^>]*><img[^>]*><\/a>/i', // Remove <a> tags containing <img>
                '/<img[^>]*>/i',              // Remove standalone <img> tags
                '/<p.*?>(.*?)<\/p>/si'        // Extract text inside <p> tags
              ], [
                '', // Replace <a> with <img> with nothing
                '', // Replace <img> with nothing
                '$1' // Extract only content inside <p>
              ], $article->content);
            @endphp
            <p>
                {!! Str::limit($content, 725, ' . . .') !!}
            </p>
        </div>      
        <a href="/blog/{{$article->slug}}" class="btn btn-primary">Lihat Detail <i class="fa fa-long-arrow-right"></i></a>
      </div>
    </div>
    @endforeach
</div>
@else
  <style>
    .page {
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 100;
        height: 100vh;
    }

  </style>
  <div class="full-height bg-white mt-5 d-flex align-items-center justify-content-center" style="height: 10vh;">
    <div class="code font-weight-bold text-center" style="border-right: 3px solid; font-size: 60px; padding: 0 15px 0 15px;">
      404
    </div>
    <div class="text-center" style="padding: 10px; font-size: 46px;">
      Not Found
    </div>
  </div>
@endif