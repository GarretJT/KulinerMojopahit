@if ($article instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <!-- Loop through the paginated articles -->
  @foreach($article as $singleArticle)
    <div class="section-header mt-3">
      <div class="mb-3">
        <div class="text-dark" style="font-size: 40px; letter-spacing: .5px; line-height: 1.3;">
          {{$singleArticle->title}} <!-- This is now a single Article instance -->
        </div>
        <div class="mt-1">
          <small class="font-italic">Created At: {{ date('d M Y', strtotime($singleArticle->created_at)) }} |</small>
          @foreach($singleArticle->categories as $value)
              <a class="d-inline underline" href="{{ route('blog', ['c' => $value->name]) }}">
                  <small class="font-italic">{{ $value->name }},</small>
              </a>
          @endforeach
        </div>
      </div>
      <p class="mb-3 article text-justify">
        {!! $singleArticle->content !!} <!-- Display article content -->
      </p>
    </div>
  @endforeach
@else
  <!-- Handle the single article case -->
  <div class="section-header mt-3">
    <div class="mb-3">
      <div class="text-dark" style="font-size: 40px; letter-spacing: .5px; line-height: 1.3;">
        {{$article->title}} <!-- This is a single Article instance -->
      </div>
      <div class="mt-1">
        <small class="font-italic">Created At: {{ date('d M Y', strtotime($article->created_at)) }} |</small>
        @foreach($article->categories as $value)
            <a class="d-inline underline" href="{{ route('blog', ['c' => $value->name]) }}">
                <small class="font-italic">{{ $value->name }},</small>
            </a>
        @endforeach
      </div>
    </div>
    <p class="mb-3 article text-justify">
      {!! $article->content !!} <!-- Display article content -->
    </p>
  </div>
@endif
