@if($event->done == null)
 <div class="modal fade" id="invite">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inviteModal">Invite Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="jumbotron p-1 mb-1 mt-1">
          @foreach($event->event_invites as $invite)
              <div class="row mb-4">
                <div class="col-md-3  col-3">
                  <a href="{{ url('profile/' . $invite->receiver->id)}}" class="text-white">
                    <img src="/imgs/{{ $invite->receiver->image_path }}" class="img-fluid mx-auto rounded">
                  </a>
                </div>
                <div class="col-md-6 col-6">
                  <h3 class="my-4">
                    <a href="{{ url('profile/' . $invite->receiver->id)}}" class="text-white">{{ $invite->receiver->username }}</a>
                  </h3>
                </div>
                <div class="col-md-3 col-3 d-flex align-items-center">
                  <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Cancel Invite" id="btn_cancelInvite"
                    event-id="{{$event->id}}" sender-id="{{Auth::user()->id}}" receiver-id="{{$invite->receiver->id}}" current="">
                    <i class="fas fa-times" ></i><span> Cancel</span>
                  </button>
                </div>
              </div>
            @endforeach
            @foreach($users as $user)
              <div class="row mb-4">
                <div class="col-md-3  col-3">
                  <a href="{{ url('profile/' . $user->id)}}" class="text-white">
                    <img src="/imgs/{{ $user->image_path }}" class="img-fluid mx-auto rounded">
                  </a>
                </div>
                <div class="col-md-6 col-6">
                  <h3 class="my-4">
                    <a href="{{ url('profile/' . $user->id)}}" class="text-white">{{ $user->username }}</a>
                  </h3>
                </div>
                <div class="col-md-3 col-3 d-flex align-items-center">
                  <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Invite" id="btn_inviteToEvent"
                    event-id="{{$event->id}}" sender-id="{{Auth::user()->id}}" receiver-id="{{$user->id}}">
                    <i class="fas fa-plus" ></i><span> Invite</span>
                  </button>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endif

  <div class="container" style="margin-top:10em">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="d-block img-fluid" src="{{url('/imgs/natu.jpg')}}" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="{{url('/imgs/natu.jpg')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="{{url('/imgs/natu.jpg')}}" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="jumbotron" >
      <div class="row" style="display:grid;">
      <div class="flex">
      @if($event->done == null)
      <button type="button" class="btn btn-outline-danger mx-1 float-right" id="btn_deleteEvent">
        <i class="fas fa-trash-alt fa-fw"></i> Delete </button>
      <button type="button" class="btn btn-primary mx-1 float-right" id="btn_editEvent">
        <i class="far fa-edit fa-fw"></i> Edit </button>
        @endif
      <button type="button" class="btn btn-secondary mx-1 float-right" data-toggle="modal" data-target="#participants">
        <i class="fas fa-clipboard-list fa-fw"></i> Participants </button>
        @if($event->done == null)
      <button type="button" class="btn btn-secondary mx-1 float-right" data-toggle="modal" data-target="#invite">
        <i class="fas fa-plus fa-fw"></i> Invite Users </button>
        @else
          <fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
</fieldset>
        @endif
      <br>
      <br>
      </div>
      </div>
      <hr>

      <div id="event_data" data-id="{{ $event->id }}">
       <span class="display-4" id="event_name">{{$event->name}}</span>
      <span id="event_public" data-id="{{$event->is_public}}">
      @if($event->is_public)
       (Public) 
      @else 
      (Private) 
      @endif</span>
      @if($event->done != null)
        <span class="display-4">Past event</span>
      @endif
      <br>
      <div class="row mt-5">
        <div class="col-12 col-lg-5">
          <h5 id="event_date">
            <i class="fas fa-clock fa-fw mr-1" ></i>{{$event->date}} at {{$event->time}}</h5>
          <h5 id="event_localization">
            <i class="fas fa-map-marker-alt fa-fw mr-1"></i>{{$event->place}}, {{$event->city}}, {{$event->country}} </h5>
            <h5 id="address"> 
            {{$event->address}}</h5>
          <h5 id="event_category" data-id="{{ $event->category_id }}">
            Category: {{$event->category->name}}</h5>
          <br>
         <!--  <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12012.041648923578!2d-8.5976876!3d41.1779401!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x405225b4b451f7d7!2sFEUP+-+Faculdade+de+Engenharia+da+Universidade+do+Porto!5e0!3m2!1spt-PT!2spt!4v1520958961221"
              frameborder="0" allowfullscreen></iframe>
          </div> -->
        </div>
        <div class="col-12 col-lg-7">
          <h1>Description</h1>
          <br>
          <p id="event_description">
          {{$event->description}}
          </p>
        </div>
      </div>
    </div>
    </div>