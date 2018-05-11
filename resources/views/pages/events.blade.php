@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend')
@include('partials.joinEvent')
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
                <a href="./tiagoc.html" class="text-white">
                  <img src="/imgs/{{ $participant->user->image_path }}" class="img-fluid rounded">
                </a>
              </div>
              <div class="col-md-9 col-9">
                <h3>
                  <a href="./tiagoc.html" class="text-white">{{ $participant->user->username }}</a>
                </h3>
              </div>
            </div>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  @if($event->owner->id == Auth::user()->id)
    @include('partials.eventAsOwner')
  @elseif(Auth::user()->participant->inEvent($event->id) != null)
    @include('partials.eventAsParticipant')
  @else
    @include('partials.eventAsVisitor')
  @endif

 

  

    <div class="jumbotron">
      <h1 class="display-4">Discussion</h1>
      <br>
      <div class="input-group">
        <textarea class="form-control" rows="4" cols="1" placeholder="Write something here..."></textarea>
      </div>
      <div class="mt-1">
        <button type="button" class="btn btn-primary float-right">
          <i class="fas fa-comment fa-fw"></i> Post </button>
        <button type="button" class="btn btn-secondary mx-1 float-right">
          <i class="fas fa-plus fa-fw"></i> Image </button>
        <button type="button" class="btn btn-secondary float-right">
          <i class="fas fa-plus fa-fw"></i> Poll </button>
      </div>
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