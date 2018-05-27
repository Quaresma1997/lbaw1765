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
  @include('partials.addEvent')
@endif

@section('content')

 <div id="error_page">
    <h1>401 Error Page</h1>
    <p class="zoom-area">UNAUTHORIZED</p>
  <section class="error-container">
    <span>4</span>
    <span><span class="screen-reader-text">0</span></span>
    <span>1</span>
  </section>
  <div class="link-container">
    <a href="{{ route('index')}}" class="more-link">Back to homepage</a>
  </div>
</div>



@endsection