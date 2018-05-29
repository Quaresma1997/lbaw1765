@extends('layouts.app')

@section('navbar')
@include('partials.navLoggedIn')
@endsection



@section('content')

@each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
@each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
@include('partials.addEvent')
@include('partials.manageShortcuts')

<div class="row">
  <div class="col-12 col-lg-3">
    <div class="container mx-auto sticky-top" >
      <hr>
      <div>
        <h2>Shortcuts</h2>
        <div class="d-md-flex flex-lg-column justify-content-md-between" >
        @if(sizeof(Auth::user()->shortcuts) == 0)
            <span id="no_shortcuts">No shortcuts</span>
            @endif
        <div id="homepage_list_shortcuts" class="d-md-flex flex-lg-column justify-content-md-between">
          @foreach(Auth::user()->shortcuts as $shortcut)
          <a href="{{ url('events/' . $shortcut->event->id)}}" class="text-white mb-2" data-id="{{$shortcut->id}}">{{$shortcut->event->name}}</a>
          @endforeach
          
            </div>
          <button type="button" class="btn btn-secondary btn-md btn-block mt-2" id="btn_manageShortcuts" data-toggle="modal" data-target="#manageShortcuts">
                <i class="fa fa-plus fa-fw"></i> Manage Shortcuts </button>
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
