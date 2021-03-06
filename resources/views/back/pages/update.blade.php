@extends('back.layouts.master')
@section('title',$page->title.' sayfasını güncelle')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left"><strong>@yield('title')</strong></h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                   <li> {{$error}}</li>
                @endforeach
            </div>
        @endif
        <form action="{{route('admin.page.update',$page->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}
            <div class="form-group">
                <label for="title">Sayfa Başlığı</label>
            <input type="text" name="title" class="form-control" value="{{$page->title}}" required>
            </div>

            <div class="form-group">
                <label for="image">Sayfa Resmi</label><br>
                <img src="/../{{$page->image}}" width="200" alt="{{$page->image}}" class="rounded img-thumbnail mb-2">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Sayfa İçeriği</label>
                <textarea name="content" id="editor" cols="30" rows="4" class="form-control">{{$page->content}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Güncelle</button>
            </div>
        </form>
    </div>
  </div>
  
  
@endsection
@section('css')
    <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
  $('#editor').summernote(
      {
          'height':300
      }
  );
});
</script>
@endsection