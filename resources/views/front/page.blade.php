@extends('front.layouts.master')
@section('title',$page->title)
@section('bg',$page->image)

{{-- @section('title')
    Blog Sitesi
@endsection --}}
@section('content')
  <!-- Post Content -->
        <div class="col-md-9 mx-auto">
            <p>{!!$page->content!!}</p>
        </div>
@endsection
