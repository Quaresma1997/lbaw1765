@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@each('partials.addFriend', Auth::user()->friend_requests_received, 'friend_request')
@each('partials.joinEvent', Auth::user()->event_invites, 'event_invite')
@include('partials.addEvent')


@section('content')
  <div class="modal fade" id="participants">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Participants</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="jumbotron p-1 mb-1">
          @foreach($event->participants as $participant)
            
            <div class="row mb-4">
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
              @if(Auth::user()->id == $event->owner->id)
              <div class="col-md-3 col-3 d-flex align-items-center">
                  <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Remove" id="btn_removeParticipant" event-id="{{$event->id}}" user-id="{{$participant->user->id}}">
                    <i class="fas fa-times fa-fw"></i> Remove
                  </button>
                </div>
                @endif
            </div>
            
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>


  @if($event->owner->id == Auth::user()->id)
    @include('partials.eventAsOwner')
  @elseif(Auth::user()->inEvent($event->id) != null)
    @include('partials.eventAsParticipant')
  @else
    @include('partials.eventAsVisitor')
  @endif

 

  

    <div class="jumbotron">
      <h2 class="display-4">Discussion</h2>
      <br>
      <form action ="" method="get" >
            <textarea type="text" class="form-control" rows="4" cols="1" name="post" placeholder="Write something here..." required></textarea>
       
      <div class="mt-1">
        <button type="submit" class="btn btn-primary float-right">
          <i class="fas fa-comment fa-fw"></i> Post </button>
        <button type="button" class="btn btn-secondary mx-1 float-right">
          <i class="fas fa-plus fa-fw"></i> Image </button>
        <button type="button" class="btn btn-secondary float-right">
          <i class="fas fa-plus fa-fw"></i> Poll </button>
      </div>
       </form>
      <br>
      <br>
      <br>
      <hr>

      
            
         @each('partials.post', $event->posts, 'post')
         
          
  
        </div>
      </div>
    </div>
  </div>
  @endsection