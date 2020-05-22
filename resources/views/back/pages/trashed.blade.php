@extends('back.layouts.master')
@section('title','Silinmiş Sayfalar')
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
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$pages->count()}}</strong> makale bulundu <a href="{{route('admin.makaleler.index')}}" class="btn btn-sm btn-success"><i class="fa fa-globe mr-2"></i>Makaleler</a></h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                        {{-- <th>Resim</th> --}}
                        <th>Başlık</th>
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
                        <th>Oluşturulma Tarihi</th>
                        <th><i class="fa fa-recycle"></th>
                        <th><i class="fa fa-times"></th>
                    </tr>
                  </tfoot>
                  <tbody>

                    @foreach ($pages as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        {{-- <td><img src="{{$page->image}}" title="{{$page->image}}" width="200" alt="{{$page->image}}"></td> --}}
                        <td>{{$page->title}}</td>
                        <td>{{$page->created_at->diffForHumans()}}</td>
                        <td class="text-center">
                            <a title="Kurtar" href="{{route('admin.recover.page',$page->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-recycle"></i></a>
                        </td>
                        <td class="text-center">
                            <a title="Sil" href="#" class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-times"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">Silinecek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Emin misiniz?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
          @if (count($pages)>0)
          <a class="btn btn-primary" href="{{route('admin.hard.delete.page',$page->id)}}">Sil</a>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    $('.switch').change(function() {
      id=$(this)[0].getAttribute('page-id');
      statu=$(this).prop('checked');

      $.get("{{route('admin.switch')}}",{id:id,statu:statu},function(data,statu){
        // console.log(data);
      });
    })
  })
</script>
@endsection