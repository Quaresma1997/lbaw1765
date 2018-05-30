@extends('layouts.app')

@section('navbar')

@if (!Auth::check())
@include('partials.navNotLoggedIn')

@else
@include('partials.navLoggedIn')
@endif

@endsection

@section('content')
@if (Auth::check())
@each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
@each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
@include('partials.addEvent')
@endif

  <div class="modal fade" id="participants">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Participants</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="jumbotron p-1 mb-1 mt-1">
          <div class="row">
          @foreach($event->participants as $participant)
          <div class="col-12 col-lg-6 mb-4">
              <div class="row">
              <div class="col-md-3 col-3">
                <a href="{{ url('profile/' . $participant->user_id)}}" class="text-white">
                  <img src="/imgs/{{ $participant->user->image_path }}" class="img-fluid rounded">
                </a>
              </div>
              <div class="col-md-6 col-6">
              <a href="{{ url('profile/' . $participant->user_id)}}" class="text-white">
                  <h3 class="my-4">{{ $participant->user->username }}</h3>
                  </a>
              </div>
              @if(Auth::check())
              @if(Auth::user()->id == $event->owner->id)
              <div class="col-md-3 col-3 d-flex align-items-center">
                  <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Remove" id="btn_removeParticipant" event-id="{{$event->id}}" user-id="{{$participant->user->id}}">
                    <i class="fas fa-times fa-fw"></i> Remove
                  </button>
                </div>
                @endif
                @endif
            </div>
            </div>
            
          @endforeach
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>


@if(Auth::check())
  @if($event->owner->id == Auth::user()->id)
    @include('partials.eventAsOwner')
  @elseif(Auth::user()->inEvent($event->id) != null)
    @include('partials.eventAsParticipant')
  @elseif(Auth::user()->invite_to_event($event->id) != null)
    @include('partials.eventAsInvited')
  @else
    @include('partials.eventAsVisitor')
  @endif
@else
  @include('partials.eventAsVisitor')
@endif

@include('partials.addPoll')

@if ($errors->any())
        <div class="myAlert-bottom alert alert-danger" id="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
           @foreach ($errors->all() as $error)              
              <strong>Error!</strong> {{ $error }}
              <br>
            @endforeach
            </div>
@endif

@endsection