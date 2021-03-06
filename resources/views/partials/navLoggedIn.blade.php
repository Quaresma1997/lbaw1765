<a class="navbar-brand" href="{{ route('homepage')}}">EventSS</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
  <br>

  
  
    <form action ="{{route('search')}}" id="search_form" method="get" class="form-inline">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <div class="input-group">
          <input type="text" class="form-control search" name="query" placeholder="Search" id="search_field">
          <span class="input-group-append"> 
            <button type="submit" class="btn btn-secondary" id="btn_search">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </span>
        </div>
      </li>
      </ul>
    </form>
  

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href=# data-toggle="modal" data-target="#add_event">
        <i class="fas fa-plus fa-fw"></i> Add Event </a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
          <a class="nav-link" href="#" data-toggle="dropdown">
            <i class="fas fa-bell fa-fw"></i> Notifications <span class="badge badge-secondary">{{sizeof(Auth::user()->notifications())}}</span> </a>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
           @foreach(Auth::user()->notifications() as $notification)
           @if($notification->type == 1 )
           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#joinEvent{{$notification->id}}">{{$notification->sender->username}} invited you to an event</a>
           @elseif($notification->type == 2 )
           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addFriend{{$notification->id}}">{{$notification->sender->username}} wants to be your friend</a>
           @elseif($notification->type == 3 )
           <div class="dropdown-item" id="notification_event_delete" data-id="{{$notification->id}}">
            <span>{{$notification->event_name}} was deleted!</span><button type="button" id="btn_markAsSeen_notDel" class="btn btn-secondary btn-sm ml-2" title="Mark as seen">
              <i class="fas fa-check"></i>
            </button>
          </div>
          

          
          @elseif($notification->type == 4 )
          <div class="dropdown-item" id="notification_event_update" data-id="{{$notification->id}}">
            <a href="{{ url('events/' . $notification->event_id)}}" class="text-white">{{$notification->event->name}} was updated!
            </a><button type="button" id="btn_markAsSeen_notUpd" class="btn btn-secondary btn-sm ml-2" title="Mark as seen">
              <i class="fas fa-check"></i>
            </button>
          </div>
          
          @endif
          @endforeach

          

          @if(sizeof(Auth::user()->notifications()) == 0)
          <span class="dropdown-item">No notifications</span>
          @endif
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/profile/{{ Auth::user()->id }}">
        <img src="/imgs/{{ Auth::user()->image_path }}" class="userMiniImg" id="img_nav_profile" alt="User image">
        {{ Auth::user()->username }} </a>
      </li>
      <li class="navbar-item">
        <a class="nav-link" href="{{ route('logout')}}">
          <i class="fas fa-sign-out-alt fa-fw"></i> Logout </a>
        </li>
      </ul>
    </div>