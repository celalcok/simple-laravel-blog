@extends('back.layouts.master')
@section('title',$article->title.' makalesini güncelle')
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
        <form action="{{route('admin.makaleler.update',$article->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Makale Başlığı</label>
            <input type="text" name="title" class="form-control" value="{{$article->title}}" required>
            </div>
            <div class="form-group">
                <label for="category">Makale Kategorisi</label>
                <select name="category" id="" class="form-control">
                    <option value="">Seçim yapınız</option>
                    @foreach ($categories as $category)
                        <option @if($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image_source">Resim Kaynağı</label>
                <select article-id="{{$article->image_source}}"  name="image_source" id="image_source" class="form-control">
                    <option selected >Seçim yapınız</option>
                    <option @if($article->image_source==0) selected @endif value="0">Resim Yükle</option>
                    <option @if($article->image_source==1)) selected @endif value="1">URL</option>
                </select>
            </div>


          
            <div class="form-group">
                <label for="image">Makale Resmi</label><br>
                <img @if ($article->image_source==0) src="/../{{$article->image}}" @else src="{{$article->image}}" @endif width="200" class="img-thumbnail" alt=""><br>

                <input type="file" name="image" id="image" class="form-control" >

                <input type="text" id="web" name="web" class="form-control" value="{{$article->image}}">

            </div>


            <div class="form-group">
                <label for="content">Makale İçeriği</label>
                <textarea name="content" id="editor" cols="30" rows="4" class="form-control">{{$article->content}}</textarea>
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
        image_source=$('#image_source')[0].getAttribute('article-id');
        if(image_source=0){//0:resim
            $('#web').hide();
            $('#image').show();
        }
        else{ //1:url
                $('#web').show();
                $('#image').hide();
            }
        $('#image_source').change(function(){
            var val=$(this).children('option:selected').val();
            if(val=='1'){//1:url
                $('#image').hide();
                $('#web').show();
            }
            else if(val=='0'){ //0:resim
                $('#web').hide();
                $('#image').show();
            }
            else{
                $('#web').hide();
                $('#image').hide();
            }
        });



  $('#editor').summernote(
      {
          'height':300
      }
  );
});
</script>
@endsection