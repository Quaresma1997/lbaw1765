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
          <div class="col-12 col-md-6 col-xl-6">
            <div class="mx-auto content">
              <a href/taj.jpg="./event.html" class="text-white">
                <div class="content-overlay"></div>
                <img class="content-image rounded" src="{{url('/imgs/november.jpg')}}">
                <div class="content-details">
                  <h3>Apresentação LBAW</h3>
                  <p>08/03/2018
                    <br> Porto, Portugal</p>
                </div>
              </a>
            </div>

            <div class="mx-auto content">
              <a href="./event.html" class="text-white">
                <div class="content-overlay"></div>
                <img class="content-image rounded" src="{{url('/imgs/taj.jpg')}}">
                <div class="content-details">
                  <h3>Mini Teste PPIN</h3>
                  <p>14/03/2018
                    <br> Porto, Portugal</p>

                </div>
              </a>
            </div>
          </div>

          <div class="col-12 col-md-6 col-xl-6">
            <div class="mx-auto content">
              <a href="./event.html" class="text-white">
                <div class="content-overlay"></div>
                <img class="content-image rounded" src="{{url('/imgs/fer.jpg')}}">
                <div class="content-details">
                  <h3>Queima das Fitas</h3>
                  <p>06/05/2018
                    <br> Porto, Portugal</p>
                </div>
              </a>
            </div>

            <div class="mx-auto content">
              <a href="./event.html" class="text-white">
                <div class="content-overlay"></div>
                <img class="content-image rounded" src="{{url('/imgs/white.jpg')}}">
                <div class="content-details">
                  <h3>Web Summit 2018</h3>
                  <p>05/11/2018
                    <br> Lisboa, Portugal</p>
                </div>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
@endsection