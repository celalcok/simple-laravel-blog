@if (isset($categories))
<div class="col-md-3">
    <div class="list-group">
        <div class="list-group-item list-group-item-action active">
          Kategoriler
        </div>
        @foreach ($categories as $category)
    <a @if(Request::segment(2)!=$category->slug) href="{{route('category',$category->slug)}}" @endif  class="list-group-item list-group-item-action @if(Request::segment(2)==$category->slug) text-white active @endif">{{$category->name}}<span class="badge badge-pill @if(Request::segment(2)==$category->slug) badge-light text-primary @else badge-primary text-light @endif">{{$category->articleActiveCount()}}</span></a>
        @endforeach
      </div>
</div>
@endif
