@extends('layouts.app')

@if (!Auth::check())
  @section('navbar')
    @include('partials.navNotLoggedIn')
  @endsection

  @include('partials.register')
  @include('partials.login')

@else
  @section('navbar')
    @include('partials.navLoggedIn')
  @endsection
  
  @each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
  @each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
  @include('partials.addEvent');
@endif


@section('content')
<h1 class="display-4">About Us</h1>
<hr>
<div class="container">
  <h3>LBAW1765</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card m-1">
        <img class="card-img-top img-fluid rounded" src="./imgs/profile.jpg" alt="Card image">
        <div class="card-body">
          <h4 class="card-title">Mariana Guimarães</h4>
          <p class="card-text">up201307777</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card m-1">
        <img class="card-img-top img-fluid rounded" src="./imgs/profile.jpg" alt="Card image">
        <div class="card-body">
          <h4 class="card-title">Rui Quaresma</h4>
          <p class="card-text">up201503005</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card m-1">
        <img class="card-img-top img-fluid rounded" src="./imgs/profile.jpg" alt="Card image">
        <div class="card-body">
          <h4 class="card-title">Rui Araújo</h4>
          <p class="card-text">up201403263</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card m-1">
        <img class="card-img-top img-fluid rounded" src="./imgs/profile.jpg" alt="Card image">
        <div class="card-body">
          <h4 class="card-title">Tiago Carvalho</h4>
          <p class="card-text">up201504461</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection