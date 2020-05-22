@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left"><strong>@yield('title')</strong></h6>
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$articles->count()}}</strong> makale bulundu <a href="{{route('admin.trashed.article')}}" class="btn btn-sm btn-warning"><i class="fa fa-trash mr-2"></i>Çöp Kutusu</a></h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th><i class="fa fa-eye"></th>
                        <th><i class="fa fa-edit"></th>
                        <th><i class="fa fa-trash"></th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th><i class="fa fa-eye"></th>
                        <th><i class="fa fa-edit"></th>
                        <th><i class="fa fa-trash"></th>
                    </tr>
                  </tfoot>
                  <tbody id="orders">
                    
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td><img article-image="{{$article->image}}" article-image-source="{{$article->image_source}}" class="small img-thumbnail" @if ($article->image_source==0) src="/../{{$article->image}}" @else src="{{$article->image}}" @endif title="{{$article->image}}" width="200" alt="{{$article->local}}"></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td class="text-center">
                          <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td class="text-center">
                            <a title="Görüntüle" target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                            <a title="Düzenle" href="{{route('admin.makaleler.edit',$article->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        </td>
                        <td class="text-center">
                        <a article-id="{{$article->id}}" title="Sil" href="#" class="delete btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delteModal"><i class="fa fa-trash"></i></a>
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
        <form action="{{route('admin.delete.article')}}" method="post">
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Çöp Kutusuna taşınacak</h5>
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
  </div>

          {{-- Big Image --}}
  <div class="modal fade" id="bigImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{route('admin.delete.article')}}" method="post">
          @csrf
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body align-items-center">
           <img id="big"  width="450" alt="">

      </form>
      </div>
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
      $('#lbl_id').html(id+' nolu makale çöp kutusuna taşınacak.');
      $('#article_id').val(id);
      $('#deleteModal').modal();
    });
      $('.small').click(function(){
        image=$(this)[0].getAttribute('article-image');
        image_source=$(this)[0].getAttribute('article-image-source')
        if(image_source==0){
          
          $("#big").attr("src","/../"+image);
        }
        else{
          $("#big").attr("src",image);
        }
        
         $('#bigImageModal').modal();

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