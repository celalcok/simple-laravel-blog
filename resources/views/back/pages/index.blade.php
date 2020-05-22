@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('message')
<div id="orderSuccess" style="display: none" class="alert alert-success mt-3 text-center">
  Sıralama başarıyla güncellendi.
</div>

@endsection
@section('content')


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left"><strong>@yield('title')</strong></h6>
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$pages->count()}}</strong> sayfa bulundu <a href="{{route('admin.page.trashed')}}" class="btn btn-sm btn-warning"><i class="fa fa-trash mr-2"></i>Çöp Kutusu</a></h6>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th><i class="fa fa-arrows-alt"></i></th>
                        <th>ID</th>
                        {{-- <th>Resim</th> --}}
                        <th>Başlık</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>Sıralama</th>
                        <th><i class="fa fa-eye"></th>
                        <th><i class="fa fa-edit"></th>
                        <th><i class="fa fa-trash"></th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr class="text-center">
                        <th><i class="fa fa-arrows-alt"></i></th>
                        <th>ID</th>
                        {{-- <th>Resim</th> --}}
                        <th>Başlık</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>Sıralama</th>
                        <th><i class="fa fa-eye"></th>
                        <th><i class="fa fa-edit"></th>
                        <th><i class="fa fa-trash"></th>
                    </tr>
                  </tfoot>
                  <tbody id="orders">
                    
                    @foreach ($pages as $page)
                    <tr id="page_{{$page->id}}" class="text-center">
                        <td ><i style="cursor:move;" class="fa fa-arrows-alt text-muted handle"></i></td>
                        <td>{{$page->id}}</td>
                        {{-- <td><img src="/../{{$page->image}}" title="{{$page->image}}" width="200" alt="{{$page->image}}"></td> --}}
                        <td>{{$page->title}}</td>
                        <td>{{$page->created_at->diffForHumans()}}</td>
                        <td class="text-center">
                          <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($page->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td>{{$page->order}}</td>

                        <td class="text-center">
                            <a title="Görüntüle" target="_blank" href="{{route('page',$page->slug)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                            <a title="Düzenle" href="{{route('admin.page.edit',$page->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        </td>
                        <td class="text-center">
                            <a title="Sil"  class="btn btn-sm btn-danger" href="{{route('admin.page.delete',$page->id)}}" ><i class="fa fa-trash"></i></a>
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
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sayfa Silinecek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Emin misiniz?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
          @if (count($pages)>0)
          {{-- <a class="btn btn-primary" href="{{route('admin.page.delete',$page->id)}}">Sil</a> --}}
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.7.0/Sortable.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    $('#orders').sortable({
      handle:'.handle',
      update:function(){
        var siralama=$('#orders').sortable('serialize');
        console.log(siralama);
        $.get("{{route('admin.page.orders')}}?"+siralama,{orders:siralama},function(data,status){
          $('#orderSuccess').show().delay(2000).fadeOut();          
        });
      }
});

    $('.switch').change(function() {
      id=$(this)[0].getAttribute('page-id');
      statu=$(this).prop('checked');

      $.get("{{route('admin.page.switch')}}",{id:id,statu:statu},function(data,statu){
        // console.log(data);
      });
    })
  })
</script>
@endsection