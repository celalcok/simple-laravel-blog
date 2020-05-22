
    @foreach ($articles as $article)
    <div class="post-preview">
        <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
          <h2 class="post-title">
            {{$article->title}}
          </h2>
          <img src="{{$article->image}}" alt="">
          <h3 class="post-subtitle">
            {!!Str::limit($article->content,100,'... DEVAMINI OKU')!!}
          </h3>
        </a>
        <p class="post-meta">
          <a href="{{route('category',$article->getCategory->slug)}}">{{$article->getCategory->name}}</a>
          <span class="float-right">{{$article->created_at->diffForHumans()}}</span></p>
      </div>
      @if (!$loop->last)
      <hr>
      @endif
  
    @endforeach
    {{$articles->links()}}
