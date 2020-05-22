@extends('front.layouts.master')
@section('title',$article->title)
@section('bg','../'.$article->image)

{{-- @section('title')
    Blog Sitesi
@endsection --}}
@section('content')
  <!-- Post Content -->
        <div class="col-md-9 mx-auto">
            <h1>{{$article->title}}</h1>
            <p>{!!$article->content!!}</p>
        <span class="text-primary">Okunma Sayısı: <b>{{$article->hit}}</b></span>
        </div>
  @include('front.widgets.categoryWidget')


@endsection
