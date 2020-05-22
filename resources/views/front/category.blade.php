@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi | '.count($articles).' yazı bulundu.')


{{-- @section('title')
    Blog Sitesi
@endsection --}}
@section('content')
<div class="col-lg-8 col-md-10 mx-auto">
@if (count($articles)>0)
@include('front.widgets.articleList')
@else
    <div class="alert alert-danger ">
      <h2>Bu kategoriye ait yazı bulunamadı</h2>
    </div>
@endif
</div>
@include('front.widgets.categoryWidget')
@endsection
