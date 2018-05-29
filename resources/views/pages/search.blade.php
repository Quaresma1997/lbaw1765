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
                @foreach($categories as $category)
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="{{$category->id}}">
                  <label class="custom-control-label" for="{{$category->name}}">{{$category->name}}</label>
                </div>
                @endforeach
              
                <hr>
                <h2>Sort</h2>
                <div class="form-group">
                  <label for="sort_events">Sort options</label>
                  <select class="custom-select" id="sort_events">
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
                  <label for="sort_users">Sort options</label>
                  <select class="custom-select" id="sort_users">
                    <option value="1" selected="">A-Z</option>
                    <option value="2"> Z-A</option>
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
              @each('partials.event', $events, 'event')
                          
              
              </div>
            </div>

          <div class="tab-pane">
              <div class="row mt-3">
              @foreach($users as  $user)
                    <div class="col-12 col-lg-6 px-1">
                    <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                      <a href="{{ url('profile/' . $user->id)}}" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="rounded userSearchImg" src="/imgs/{{ $user->image_path }}">
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
  </div>


@endsection