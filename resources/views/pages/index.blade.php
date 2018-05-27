@extends('layouts.app')

@section('navbar')
    @include('partials.navNotLoggedIn')
@endsection

  @include('partials.register')
  @include('partials.login')



@section('content')
<div class="row">
      <div class="col-12 col-xl-6">
        <div class="jumbotron">
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
      
      <div class="col-12 col-xl-6">
        <div class="row">
          
            @foreach($most as $ev)
            <div class="col-12 col-md-6 col-xl-6">
            <div class="mx-auto content">
              <a href="/events/{{$ev->id}}" class="text-white">
                <div class="content-overlay"></div>
                <img class="content-image rounded" src="{{url('/imgs/november.jpg')}}">
                <div class="content-details">
                  <h3>{{$ev->name}}</h3>
                  <p>{{$ev->date}}
                    <br> {{$ev->localization->city->name}}, {{$ev->localization->city->country->name}}</p>
                </div>
              </a>
            </div>
            </div>
            @endforeach
          
        </div>
      </div>
    </div>
@endsection
