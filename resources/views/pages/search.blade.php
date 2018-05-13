@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend');
@include('partials.joinEvent');

@section('content')

{{$events}}

{{$users}}



  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="container mx-auto sticky-top" style="padding-top:10em">
          <div>
            <h1 class="display-4">Search</h1>
            <hr>
            <h2>Filter</h2>
            <h4>Type</h4>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="optionsRadiosType0" name="optionsRadiosType" class="custom-control-input" checked="checked">
              <label class="custom-control-label" for="optionsRadiosType0">Events</label>
            </div>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="optionsRadiosType1" name="optionsRadiosType" class="custom-control-input">
              <label class="custom-control-label" for="optionsRadiosType1">Users</label>
            </div>

            <div class="tab-content" name="filter_sort">
              <div class="tab-pane active" id="tab_events">
                <br>
                <h4>Category</h4>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="music">
                  <label class="custom-control-label" for="music">Music</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="sports">
                  <label class="custom-control-label" for="sports">Sports</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="entertainment">
                  <label class="custom-control-label" for="entertainment">Entertainment</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="educational">
                  <label class="custom-control-label" for="educational">Educational</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="other">
                  <label class="custom-control-label" for="other">Other</label>
                </div>
                <hr>
                <h2>Sort</h2>
                <div class="form-group">
                  <label for="itemCategory">Sort options</label>
                  <select class="custom-select" id="itemCategory">
                    <option value="A-Z" selected>A-Z</option>
                    <option value="Z-A">Z-A</option>
                    <option value="Most recent">Most recent</option>
                    <option value="Older">Older</option>
                  </select>
                </div>

              </div>

              <div class="tab-pane" id="tab_users">
                <hr>
                <h3>Sort</h3>
                <div class="form-group">
                  <label for="itemCategory">Sort options</label>
                  <select class="custom-select" id="itemCategory">
                    <option value="A-Z" selected="">A-Z</option>
                    <option value="Z-A"> Z-A</option>
                    <option value="Most events"> Most events</option>
                    <option value="Least events"> Least events</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-9">
        <div class="container mx-auto" style="padding-top:10em">
          <div class="tab-content" name="content">
            <div class="tab-pane active">
              <div class="row mt-3">
                <div class="col-12 col-lg-6 px-1">

                 @foreach($events as $event)
                  <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                    <a href="/events/{{$event->id}}" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="./imgs/pyra.jpg">
                        </div>
                        <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
                          <div class="my-1">
                            <h4>{{$event->name}}</h4>
                            <p>{{$event->date}}
                              <br> {{$event->localization->city->name}}, {{$event->localization->city->country->name}}</p>
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
            @foreach($users as $user)

            <div class="tab-pane">
              <div class="row mt-3">
                <div class="col-12 col-lg-6 px-1">
                  <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                    <a href="/profile/{{$user->id}}" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="{{$user->image_path}}">
                        </div>
                        <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
                          <div>
                            <h3 class="my-4">{{$user->username}}</h3>
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



@endsection