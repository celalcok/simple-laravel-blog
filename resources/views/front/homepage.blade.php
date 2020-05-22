@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
<div class="col-lg-8 col-md-10 mx-auto">
@if (count($articles)>0)
@include('front.widgets.articleList')
@else
    <div class="alert alert-danger ">
      <h2> Yazı bulunamadı</h2>
    </div>
@endif
</div>
@include('front.widgets.categoryWidget')
@endsection
