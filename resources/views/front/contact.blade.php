@extends('front.layouts.master')
@section('title','İletişim')


@section('content')
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          @if (session('success'))
          <div class="aler alert-success p-3">
            {{session('success')}}
          </div>
  
          @endif
          @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
          @endif
        </div>
      </div>
      <div class="row">

        <div class="col-lg-8 col-md-10 mx-auto">
          <p>Bizimle iletişime geçebilirsiniz!</p>
          <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
          <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
          <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="POST" action="{{route('contact.post')}}" novalidate>
          @csrf  
          <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Adı Soyadı</label>
                <input type="text" class="form-control" value="{{old('name')}}" placeholder="Ad soyadınız" name="name" id="name" required data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Adresi</label>
                <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Adresiniz" name="email" id="email" required data-validation-required-message="Lütfen email adresinizi giriniz">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Konu</label>
                <select class="form-control" name="topic" id="topic">
                  <option @if(old('topic')=='Bilgi') selected @endif value="bilgi">Bilgi</option>
                  <option @if(old('topic')=='Destek') selected @endif value="destek">Destek</option>
                  <option @if(old('topic')=='Genel') selected @endif value="genel">Genel</option>
                </select>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Mesajınız</label>
                <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" id="message" required data-validation-required-message="Please enter a message.">{{old('message')}}</textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  
@endsection
