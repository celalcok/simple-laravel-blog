@extends('back.layouts.master')
@section('title',$category->name.' kategorisini güncelle')
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
        <form action="{{route('admin.category.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$category->id}}" id="category_id">
            <div class="form-group">
                <label for="name">Kategori Adı</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}" placeholder="Kategori adını giriniz" required>
            </div>
            <div class="form-group">
                <label for="name">Kategori Slug</label>
                <input type="text" class="form-control" name="slug" id="slug" value="{{$category->slug}}" placeholder="Kategori slug giriniz" required>
            </div>

    </div>
    <div class="modal-footer">
      <button class="btn btn-warning" type="button" data-dismiss="modal">İptal</button>
      <button class="btn btn-primary" type="submit" data-dismiss="modal">Güncelle</button>
    </form>

    </div>
  </div>
  
  
@endsection
