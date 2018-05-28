@extends('layouts.app')

@section('navbar')

@if (!Auth::check())
@include('partials.navNotLoggedIn')

@else
@include('partials.navLoggedIn')
@endif

@endsection

@section('content')
@if (!Auth::check())
@include('partials.register')
@include('partials.login')
@else
@each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
@each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
@include('partials.addEvent')
@endif

<div id="error_page">
  <h1>500 Error Page</h1>
  <p class="zoom-area">SERVER ERROR</p>
  <section class="error-container">
    <span>5</span>
    <span><span class="screen-reader-text">0</span></span>
    <span>0</span>
  </section>
  <div class="link-container">
    <a href="{{ route('index')}}" class="more-link">Back to homepage</a>
  </div>
</div>



@endsection