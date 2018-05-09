@extends('layouts.app')

@section('navbar')
    @include('partials.navAdmin')
@endsection

@section('content')

    <div class="container" style="margin-top:10em">
    <h1 class="display-4">Administration</h1>
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
 
@endsection
