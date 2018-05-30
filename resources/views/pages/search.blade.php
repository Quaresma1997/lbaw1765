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


@if (count($events) === 0  and count($users) === 0 )

    <h2>No results found!</h2> 
@endif

    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="container mx-auto sticky-top offset">
          <div>
            <h1 class="display-4" id="search_title">Search</h1>
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
                @foreach($categories as $category)
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="{{$category->id}}" name="search_cat">
                  <label class="custom-control-label" for="{{$category->id}}">{{$category->name}}</label>
                </div>
                @endforeach
              
                <hr>
                <h2>Sort</h2>
                <div class="form-group">
                  <label for="sort_events">Sort options</label>
                  <select class="custom-select" id="sort_events">
                    <option value="A-Z" selected>A-Z</option>
                    <option value="Z-A">Z-A</option>
                    <option value="Upword Date">Upword Date</option>
                    <option value="Downword Date">Downword Date</option>
                  </select>
                </div>

              </div>

              <div class="tab-pane" id="tab_users">
                <hr>
                <h3>Sort</h3>
                <div class="form-group">
                  <label for="sort_users">Sort options</label>
                  <select class="custom-select" id="sort_users">
                    <option value="A-Z" selected="">A-Z</option>
                    <option value="Z-A"> Z-A</option>
                    <option value="Most events">Most events</option>
                    <option value="Least events">Least events</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-9">
        <div class="container mx-auto offset">
          <div class="tab-content" name="content">
            <div class="tab-pane active">
              <div class="row mt-3" id="search_list_of_events">
                
                @each('partials.event', $events, 'event')
                          
              
              </div>
            </div>

          <div class="tab-pane">
              <div class="row mt-3" id="search_list_of_users" >
              @foreach($users as  $user)
                    <div class="col-12 col-lg-6 px-1" data-name-div="search_user" data-number-events="{{$user->numEvents()}}" data-name="{{$user->username}}">
                    <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                      <a href="{{ url('profile/' . $user->id)}}" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="rounded userSearchImg" src="/imgs/{{ $user->image_path }}" alt="User image">
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