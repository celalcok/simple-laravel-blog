@extends('back.layouts.master')
@section('title','Silinmiş Makaleler')
@section('content')
          <div class="row">
            <div class="col-12">
              @if (session('success'))
              <div class="alert alert-success">
                  {{session('success')}}
              </div>
              @endif
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left"><strong>@yield('title')</strong></h6>
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$articles->count()}}</strong> makale bulundu <a href="{{route('admin.makaleler.index')}}" class="btn btn-sm btn-success"><i class="fa fa-globe mr-2"></i>Makaleler</a></h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                        {{-- <th>Resim</th> --}}
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th><i class="fa fa-recycle"></th>
                          <th><i class="fa fa-times"></th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        {{-- <th>Resim</th> --}}
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th><i class="fa fa-recycle"></th>
                        <th><i class="fa fa-times"></th>
                    </tr>
                  </tfoot>
                  <tbody>

                    @foreach ($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        {{-- <td><img src="{{$article->image}}" title="{{$article->image}}" width="200" alt="{{$article->image}}"></td> --}}
                        <td><a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">{{$article->title}}</a></td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td class="text-center">
                            <a title="Kurtar" href="{{route('admin.recover.article',$article->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-recycle"></i></a>
                        </td>
                        <td class="text-center">
                        <a article-id="{{$article->id}}" title="Sil" href="#" class="delete btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
           <!-- Logout Modal-->
           <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="{{route('admin.hard.delete.article')}}" method="post">
                  @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Silinecek</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
        
                  <input type="hidden" name="article_id" id="article_id">
                  <p id="lbl_id"></p>
                  <p>Emin misiniz?</p></div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                  @if (count($articles)>0)
                  <button type="submit" id="confirm_delete" class="btn btn-primary" href="">Taşı</button>
                  @endif
                </div>
              </form>
              </div>
            </div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    $('.delete').click(function(){
      id=$(this)[0].getAttribute('article-id');
      $('#lbl_id').html(id+' nolu makale kalıcı olarak silinecek.');
      $('#article_id').val(id);
      $('#deleteModal').modal();
    });




    $('.switch').change(function() {
      id=$(this)[0].getAttribute('article-id');
      statu=$(this).prop('checked');

      $.get("{{route('admin.switch')}}",{id:id,statu:statu},function(data,statu){
        // console.log(data);
      });
    })
  })
</script>
@endsection