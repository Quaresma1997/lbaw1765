@extends('layouts.app')

@section('navbar')
@include('partials.navLoggedIn')
@endsection



@section('content')

@each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
@each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
@include('partials.addEvent')

<div class="row">
  <div class="col-12 col-lg-3">
    <div class="container mx-auto sticky-top" >
      <div>
        <h2>Filter</h2>
        <div class="d-md-flex d-sm-flex flex-lg-column justify-content-md-between justify-content-sm-between">
          <div class="custom-control custom-radio mb-1">
            <input type="radio" id="all" name="customRadio" class="custom-control-input" checked="checked">
            <label class="custom-control-label" for="all">Show All</label>
          </div>
          <div class="custom-control custom-radio mb-1">
            <input type="radio" id="friend" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="friend">Friend Activity</label>
          </div>
          <div class="custom-control custom-radio mb-1">
            <input type="radio" id="recom" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="recom">Recommendations</label>
          </div>
        </div>
      </div>
      <hr>
      <div>
        <h2>Shortcuts</h2>
        <div class="d-md-flex flex-lg-column justify-content-md-between ">
          <a href="./eventPart.html" class="text-white">Apresentação LBAW</a>
          <br>
          <a href="./eventPart.html" class="text-white">Mini Teste PPIN</a>
          <br>
          <a href="./eventPart.html" class="text-white">Queima das Fitas</a>
          <br>
          <a href="./eventPart.html" class="text-white">Web Summit 2018</a>
          <br>
          <a href="./eventPart.html" class="text-white">Apresentação LBAW</a>
          <br>
          <a href="./eventPart.html" class="text-white">Mini Teste PPIN</a>
        </div>
      </div>
      <hr>
      <div class="pb-3">
        <h2>LBAW1765</h2>
        <a href="{{ route('about') }}" class="text-white">About Us</a>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-9">
    <div class="container" >
      <div class="row">
        @if(sizeof(Auth::user()->getFriendsEvents()) == 0)

        <h3>There are no friend activities to show!</h3>
        
        @endif

        @each('partials.eventExtended', Auth::user()->getFriendsEvents(), 'event')
        
      </div>
    </div>
  </div>
</div>

@endsection
