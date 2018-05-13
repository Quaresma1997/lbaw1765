@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
@each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
@include('partials.addEvent')

@section('content')
<div class="row">
      <div class="col-12 col-lg-4">
        <div class="container mx-auto sticky-top">
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
            @if(Auth::user()->id == $user->id)
              @include('partials.userProfile')
            @elseif(Auth::user()->friendWith($user->id) != null)
              @include('partials.friendProfile')
            @else
              @include('partials.otherUserProfile')
            @endif
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-8">
        <div class="container mx-auto">
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
              <div class="row">
                @each('partials.event', $user->events()->get(), 'event')
                </div>
              </div>


              <div id="friends" class="container tab-pane fade">
                <div class="row mt-3">
                  @foreach($user->getFriends() as $friend)
                    <div class="col-12 col-lg-6 px-1">
                    <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                      <a href="{{ url('profile/' . $friend->id)}}" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="/imgs/{{ $friend->image_path }}">
                        </div>
                        <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
                          <div>
                            <h3 class="my-4">{{$friend->username}}</h3>
                          </div>
                        </div>
                      </div>
                      </a>
                    </div>
                  </div>
                  @endforeach
                  
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection