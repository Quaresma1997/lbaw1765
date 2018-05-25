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

<div class="row">
      <div class="col-12 col-lg-4">
        <div class="container mx-auto sticky-top" id="container_user">
          <h1>{{$user->username}}</h1>
          <hr>
          <div id="user_info_container" data-id="{{ $user->id }}">
            <img src="/imgs/{{ $user->image_path }}" id="user_info_img" class="img img-fluid rounded mb-3">
            <br>
            <label id="user_info_l1"><i class="fas fa-user fa-fw mr-1"></i>{{$user->first_name}} {{$user->last_name}}</label>
            <br>
            <label id="user_info_l2"><i class="fas fa-envelope fa-fw mr-1"></i>{{$user->email}}</label>
            <br>
            <label id="user_info_l3"><i class="fas fa-map-marker-alt fa-fw mr-1"></i>{{$city}}, {{$country}}</label>
            @if(Auth::check())
              @if(Auth::user()->id == $user->id)
                @include('partials.userProfile')
              @elseif(Auth::user()->friendWith($user->id) != null)
                @include('partials.friendProfile')
              @else
                @include('partials.otherUserProfile')
              @endif
            @endif
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-8 mt-3">
        <div class="container" id="event_friend_tabs">
          <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#events">
                <h3>Events</h3>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#friends">
                <h3>Friends</h3>
              </a>
            </li>
          </ul>

          <div class="container">
            <div class="tab-content">
              <div id="events" class="container tab-pane fade show active">
              <div class="row mt-3">
                @if(Auth::check())
                  @if(Auth::user()->id == $user->id)
                     @if(sizeof($user->allEvents()) == 0)
                      <h3>There are no events to show!</h3>
                      @endif
                     @each('partials.event', $user->allEvents(), 'event')
                  @else
                    @if(sizeof($user->publicEvents()) == 0)
                      <h3>There are no events to show!</h3>
                      @endif
                     @each('partials.event', $user->publicEvents(), 'event')
                  @endif
                @else
                  @if(sizeof($user->publicEvents()) == 0)
                      <h3>There are no events to show!</h3>
                      @endif
                     @each('partials.event', $user->publicEvents(), 'event')
                @endif

             
                </div>
              </div>


              <div id="friends" class="container tab-pane fade">
                <div class="row mt-3">
                @if(sizeof($user->getFriends()) == 0 )

                <h3>There are no friends to show!</h3>

                @endif

                @each('partials.friend', $user->getFriends(), 'friend')


                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection