@extends('layouts.app')

@section('navbar')
    @include('partials.navAdmin')
@endsection

@section('content')

<div class="offset">
  <div class="jumbotron container" id="jumbotron_admin">
    <h1 >Administration</h1>
    <hr>
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#tab_events">
          <h4>Events</h4>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tab_users">
          <h4>Users</h4>
        </a>
      </li>
    </ul>

    <div class="tab-content">
      <div id="tab_events" class="container tab-pane fade show active">
        @include('partials.adminEvents')
      </div>
      <div id="tab_users" class="container tab-pane fade">
        @include('partials.adminUsers')
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
