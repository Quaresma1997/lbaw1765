<a class="navbar-brand" href="{{ route('homepage')}}">EventSS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <br>

      
      <ul class="navbar-nav mr-auto">
      <form action ="{{route('search')}}" method="get" class="form-inline">
        <li class="nav-item">
          <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="Search" required>
            <span class="input-group-append"> 
              <button type="submit" class="btn btn-secondary" >
                <i class="fas fa-search fa-fw"></i>
              </button>
            </span>
          </div>
        </li>
        </form>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href=# data-toggle="modal" data-target="#add_event">
            <i class="fas fa-plus fa-fw"></i> Add Event </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="fas fa-bell fa-fw"></i> Notifications </a>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
           @foreach(Auth::user()->notifications() as $notification)
            @if($notification->type == 1 )
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#joinEvent{{$notification->id}}">{{$notification->sender->username}} invited you to an event</a>
           @elseif($notification->type == 2 )
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addFriend{{$notification->id}}">{{$notification->sender->username}} wants to be your friend</a>
            @elseif($notification->type == 3 )
              <span class="dropdown-item">{{$notification->event_name}} was deleted!</span>
            @elseif($notification->type == 4 )
               <a href="{{ url('events/' . $notification->event_id)}}" class="dropdown-item">{{$notification->event->name}} was updated!</a>
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
              <img src="/imgs/{{ Auth::user()->image_path }}" style="max-height: 30px; max-width: 30px;" id="img_nav_profile">
             {{ Auth::user()->username }} </a>
        </li>
        <li class="navbar-item">
          <a class="nav-link" href="{{ route('logout')}}">
            <i class="fas fa-sign-out-alt fa-fw"></i> Logout </a>
        </li>
      </ul>
    </div>