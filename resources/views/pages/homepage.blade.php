@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend');
@include('partials.joinEvent');
@include('partials.addEvent');

@section('content')

  <div class="row">
      <div class="col-12 col-xl-3">
        <div class="container mx-auto sticky-top" >
          <div>
            <h2>Filter</h2>
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
          <hr>
          <div>
            <h2>Shortcuts</h2>
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
          <hr>
          <div>
            <h2>LBAW1765</h2>
            <a href="{{ route('about') }}" class="text-white">About Us</a>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-9">
        <div class="container" >
          <div class="row">
            @each('partials.eventExtended', $events, 'event')
           
          </div>
        </div>
      </div>
    </div>

@endsection
