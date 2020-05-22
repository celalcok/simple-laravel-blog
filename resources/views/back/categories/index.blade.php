@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Kadegori Adı</label>
                        <input type="text" class="form-control" name="name" placeholder="Kategori adını giriniz" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori Adı</th>
                            <th>Kategori Slug</th>
                            <th>Makale Sayısı</th>
                            <th>Aftif Makale Sayısı</th>
                            <th>Pasif Makale Sayısı</th>
                            <th>Durum</th>
                            <th><i class="fa fa-eye"></th>
                            <th><i class="fa fa-edit"></th>
                            <th><i class="fa fa-trash"></th>
                          </tr>
                      </thead>
                      <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Kategori Adı</th>
                            <th>Kategori Slug</th>
                            <th>Makale Sayısı</th>
                            <th>Aftif Makale Sayısı</th>
                            <th>Pasif Makale Sayısı</th>
                            <th>Durum</th>
                            <th><i class="fa fa-eye"></th>
                            <th><i class="fa fa-edit"></th>
                            <th><i class="fa fa-trash"></th>
                        </tr>
                      </tfoot>
                      <tbody>
                        
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->articleCount()}}</td>
                            <td>{{$category->articleActiveCount()}}</td>
                            <td>{{$category->articlePassiveCount()}}</td>
                            <td class="text-center">
                              <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($category->status==1) checked @endif data-toggle="toggle">
                            </td>

                            <td class="text-center">
                            <a category-id="{{$category->id}}"  title="Düzenle"  class="edit-click btn btn-sm btn-warning text-white" > <i class="fa fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                              <label for="" class="lbl-count"></label>
                            <a category-id="{{$category->id}}" article-count="{{$category->articleCount()}}" category-name="{{$category->name}}" title="Sil"  class="remove-click btn btn-sm btn-danger text-white" > <i class="fa fa-trash"></i></a>
                            </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
    
            </div>
        </div>
    </div>
        <!-- Edit Modal-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kategori Düzenle</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.category.update')}}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{$category->id}}" id="id">
                        <label id="lbl_id" for=""></label>
                        <div class="form-group">
                            <label for="name">Kategori Adı</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Kategori adını giriniz" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Kategori Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Kategori slug giriniz" required>
                        </div>

                </div>
                <div class="modal-footer">
                  <button class="btn btn-warning" type="button" data-dismiss="modal">İptal</button>
                  <button class="btn btn-primary">Güncelle</button>
                </form>
               
                </div>
              </div>
            </div>
          </div>
                  <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="{{route('admin.category.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="delete_id">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kategori Sil</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="articleAlert" class="alert alert-danger" >
                  
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">İptal</button>
                <button id="btnDelete" class="btn btn-danger">Sil</button>
              </form>
             
              </div>
            </div>
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

    //Edit
      $('.edit-click').click(function(){
      
        id=$(this)[0].getAttribute('category-id');
        $.ajax({
            type:'GET',
            url:'{{route('admin.category.getdata')}}',
            data:{id:id},
            success:function(data){
                $('#name').val(data.name);
                $('#slug').val(data.slug);
                $('#id').val(data.id);
                $('#lbl_id').html(data.id);
                $('#editModal').modal();
            }
        });
      });



      //Delete
      $('.remove-click').click(function(){
      id=$(this)[0].getAttribute('category-id');
      count=$(this)[0].getAttribute('article-count');
      name=$(this)[0].getAttribute('category-name');
      $('#delete_id').val(id);
      if(id==1){
        $('#articleAlert').html('<h4><strong>'+name+'</strong> kategorisi sabittir. </h4><p class="text-muted">Silinen diğer kategorilere ait makaleler burada depolanır</p>');
        $('#btnDelete').hide();
        $('#deleteModal').modal();
        return;
      }
      if(count>0){
        $('#articleAlert').html('<strong>'+name+' </strong> kategorisine ait <strong>'+count+'</strong>  tane makele mevcut. Silmek istediğinizden emin misiniz?');
        $('#deleteModal').modal();
        $('#btnDelete').show();
      }

    });



      //Switch
    $('.switch').change(function() {
      id=$(this)[0].getAttribute('category-id');
      statu=$(this).prop('checked');

      $.get("{{route('admin.category.switch')}}",{id:id,statu:statu},function(data,statu){
        console.log(data);
      });
    })
  })
</script>
@endsection