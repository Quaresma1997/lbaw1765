@extends('layouts.app')

@section('navbar')
@include('partials.navNotLoggedIn')
@endsection



@section('content')


<div class="row offset">
  <div class="col-12 col-xl-5">
    <div class="jumbotron" style="margin-left: -70px;">
      <h1 class="display-3">Welcome</h1>
      <p class="lead">EventSS is a website where you can find your favorite events or share your own. Create events, invite your friends
      and share with the world!</p>
      <hr class="my-4">
      <p>Project developed by group lbaw1765, click the button below to learn more about us.</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{ route('about') }}" role="button">About Us</a>
      </p>
    </div>
  </div>
  
  <div class="col-12 col-xl-7">
    <div class="row">
      
      @foreach($most as $event)
      <div class="col-12 col-md-6 col-xl-6">
        <div class="mx-auto content">
          <a href="/events/{{$event->id}}" class="text-white">
            <div class="content-overlay"></div>
            <img class="content-image rounded eventIndexImg" src="{{url('/imgs/' . $event->images->last()->path)}}">
            <div class="content-details">
              <h3>{{$event->name}}</h3>
              <p>{{$event->date}}
                <br> {{$event->localization->city->name}}, {{$event->localization->city->country->name}}</p>
              </div>
            </a>
          </div>
        </div>
        @endforeach
        
      </div>
    </div>
  </div>

  @if ($errors->any())
        <div class="myAlert-bottom alert alert-danger" id="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
           @foreach ($errors->all() as $error)              
              <strong>Error!</strong> {{ $error }}
              <br>
            @endforeach
            </div>
@endif


  @endsection
