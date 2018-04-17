@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend');
@include('partials.joinEvent');
@include('partials.addEvent');

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
            <div class="row">
              <div class="col-md-3 col-3">
                <a href="./tiagoc.html" class="text-white">
                  <img src="./imgs/profile.jpg" class="img-fluid rounded">
                </a>
              </div>
              <div class="col-md-9 col-9">
                <h3>
                  <a href="./tiagoc.html" class="text-white">TiagoC</a>
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
            <div class="row">
              <div class="col-md-3  col-3">
                <a href="./quaresma.html" class="text-white">
                  <img src="./imgs/profile.jpg" class="img-fluid mx-auto rounded">
                </a>
              </div>
              <div class="col-md-7 col-7">
                <h3>
                  <a href="./quaresma.html" class="text-white">Quaresma1997</a>
                </h3>
              </div>
              <div class="col-md-2 col-2 d-flex align-items-center">
                <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Invite">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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

    <div class="jumbotron" data-id="{{ $event->id }}">
      <button type="button" class="btn btn-outline-danger mx-1 float-right" id="btn_deleteEvent">
        <i class="fas fa-trash-alt fa-fw"></i> Delete </button>
      <button type="button" class="btn btn-primary mx-1 float-right">
        <i class="far fa-edit fa-fw"></i> Edit </button>
      <button type="button" class="btn btn-secondary mx-1 float-right" data-toggle="modal" data-target="#participants">
        <i class="fas fa-clipboard-list fa-fw"></i> Participants </button>
      <button type="button" class="btn btn-secondary mx-1 float-right" data-toggle="modal" data-target="#invite">
        <i class="fas fa-plus fa-fw"></i> Invite Users </button>
      <br>
      <br>
      <hr>
      <h1 class="display-4">{{$event->name}}</h1>
      <br>
      <div class="row">
        <div class="col-12 col-lg-5">
          <h5>
            <i class="fas fa-clock fa-fw"></i> {{$event->date}} </h5>
          <h5>
            <i class="fas fa-map-marker-alt fa-fw"></i> {{$event->place}}, {{$event->city}}, {{$event->country}} </h5>
          <br>
          <!-- <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12012.041648923578!2d-8.5976876!3d41.1779401!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x405225b4b451f7d7!2sFEUP+-+Faculdade+de+Engenharia+da+Universidade+do+Porto!5e0!3m2!1spt-PT!2spt!4v1520958961221"
              frameborder="0" allowfullscreen></iframe>
          </div> -->
        </div>
        <div class="col-12 col-lg-7">
          <h1>Description</h1>
          <br>
          <p>
          {{$event->description}}
          </p>
        </div>
      </div>
    </div>

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
      <div class "container">
        <div class="row">
          <div class="col-3 offset-2 col-md-2 col-lg-1">
            <a href="./tiagoc.html" class="text-white">
              <img src="./imgs/com.jpg" class="rounded-circle">
            </a>
          </div>
          <div class="col-7">
            <h5>
              <a href="./tiagoc.html" class="text-white">TiagoC</a>
              <br>
              <small class="text-muted">08/03 at 12:55</small>
            </h5>
          </div>
          <div class="col-8 offset-2">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              <br> Nec ultrices dui sapien eget mi proin sed libero.
              <br> Egestas sed tempus urna et pharetra.
              <br> Amet nisl purus in mollis nunc sed id.
              <br>
              <a class="text-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="ion-reply"></i>
                <strong> Comments </strong>
              </a>
              <a href=# class="text-primary float-right mx-1">
                <strong> Delete </strong>
              </a>
              <a href=# class="text-primary float-right mx-1">
                <strong> Edit </strong>
              </a>
            </p>
          </div>
          <div class="collapse col-7 offset-3" id="collapseExample">
            <div class="row">
              <div class="col-5 col-md-2">
                <a href="./quaresma.html" class="text-white">
                  <img src="./imgs/com.jpg" class="rounded-circle">
                </a>
              </div>
              <div class="col-7">
                <h5>
                  <a href="./quaresma.html" class="text-white">Quaresma1997</a>
                  <br>
                  <small class="text-muted">08/03 at 13:23</small>
                </h5>
              </div>
            </div>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              <br> Nec ultrices dui sapien eget mi proin sed libero.
            </p>
            <div class="row">
              <div class="col-5 col-md-2">
                <a href="./quaresma.html" class="text-white">
                  <img src="./imgs/com.jpg" class="rounded-circle">
                </a>
              </div>
              <div class="col-7">
                <h5>
                  <a href="./quaresma.html" class="text-white">Quaresma1997</a>
                  <br>
                  <small class="text-muted">08/03 at 13:25</small>
                </h5>
              </div>
            </div>
            <p>Should this event be delayed?</p>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="yes" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="yes">Yes</label>
            </div>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="no" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="no">No</label>
            </div>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="maybe" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="maybe">Maybe</label>
            </div>
            <br>
            <div class="input-group m-1">
              <textarea class="form-control" rows="4" cols="1" placeholder="Write something here..."></textarea>
            </div>
            <div class="mt-1">
              <button type="button" class="btn btn-primary float-right">
                <i class="fas fa-comment fa-fw"></i> Comment </button>
              <button type="button" class="btn btn-secondary mx-1 float-right">
                <i class="fas fa-plus fa-fw"></i> Image </button>
              <button type="button" class="btn btn-secondary float-right">
                <i class="fas fa-plus fa-fw"></i> Poll </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection