@extends('back.layouts.master')
@section('title','Ayarlar')
@section('content')
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left"><strong>@yield('title')</strong></h6>
             </div>
            <div class="card-body">
                <form action="{{route('admin.config.update')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    {{-- Sol Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Site Başlığı</label>
                        <input type="text" name="title" id="title" value="{{$config->title}}" required class="form-control" placeholder="" aria-describedby="helpId">
                      </div>
                    </div>
                    {{-- Sağ Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Site Aktiflik Durumu</label>
                        <select name="active" id="active" class="form-control">
                          <option @if($config->active==1) selected @endif value="1">Açık</option>
                          <option @if($config->active==0) selected @endif value="0">Kapalı</option>
                        </select>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    {{-- Sol Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Site Logo</label>
                        <input type="file" name="logo" id="logo"  class="form-control" placeholder="" aria-describedby="helpId">
                        <small><a href="{{route('admin.config.logosil')}}">Logoyu Sil</a></small>
                      </div>
                    </div>
                    {{-- Sağ Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Site Favicon</label>
                        <input type="file" name="favicon" id="favicon"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    {{-- Sol Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" name="facebook" id="facebook" value="{{$config->facebook}}"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>
                    </div>
                    {{-- Sağ Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Twitter</label>
                        <input type="text" name="twitter" id="twitter" value="{{$config->twitter}}"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    {{-- Sol Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Youtube</label>
                        <input type="text" name="youtube" id="youtube" value="{{$config->youtube}}"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>
                    </div>
                    {{-- Sağ Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Instagram</label>
                        <input type="text" name="instagram" id="instagram" value="{{$config->instagram}}"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    {{-- Sol Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Linkedin</label>
                        <input type="text" name="linkedin" id="linkedin" value="{{$config->linkedin}}"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>
                    </div>
                    {{-- Sağ Sütun --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Github</label>
                        <input type="text" name="github" id="github" value="{{$config->github}}"  class="form-control" placeholder="" aria-describedby="helpId">
                      </div>

                    </div>
                    <div class=" col-md-12  form-group">
                      <button type="submit" class="btn btn-block btn-primary">Kaydet</button>
                    </div>

                  </div>

                </form>
            </div>
          </div>
@endsection
