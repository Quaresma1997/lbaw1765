@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend');
@include('partials.joinEvent');
@include('partials.addEvent');

@section('content')
<div class="row">
      <div class="col-12 col-lg-4">
        <div class="container mx-auto sticky-top">
          <h1>{{$user->username}}</h1>
          <hr>
          <div id="user_info_container" data-id="{{ $user->id }}">
            <img src="{{url($user->image_path)}}" id="user_info_img" class="img img-fluid rounded mb-3">
            <br>
            <label id="user_info_l1"><i class="fas fa-user fa-fw mr-1"></i>{{$user->first_name}} {{$user->last_name}}</label>
            <br>
            <label id="user_info_l2"><i class="fas fa-envelope fa-fw mr-1"></i>{{$user->email}}</label>
            <br>
            <label id="user_info_l3"><i class="fas fa-map-marker-alt fa-fw mr-1"></i>{{$city}}, {{$country}}</label>
            <button type="button" class="btn btn-primary btn-lg btn-block mt-3" id="btn_editprofile">
              <i class="far fa-edit fa-fw"></i> Edit Profile </button>
            <button type="button" class="btn btn-outline-danger btn-lg btn-block" id="btn_deleteprofile">
              <i class="far fa-trash-alt fa-fw"></i> Delete Profile </button>
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
              @each('partials.event', $user->events(), 'event')
              </div>


              <div id="friends" class="container tab-pane fade">
                <div class="row mt-3">
                  <div class="col-12 col-lg-6 px-1">
                    <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                      <a href="./quaresma.html" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="{{url('/imgs/profile.jpg')}}">
                        </div>
                        <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
                          <div>
                            <h3 class="my-4">Quaresma1997</h3>
                          </div>
                        </div>
                      </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 px-1">
                    <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="{{url('/imgs/profile.jpg')}}">
                        </div>
                        <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
                          <div>
                            <h3 class="my-4">Quaresma1997</h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection