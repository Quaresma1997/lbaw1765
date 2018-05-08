<a class="navbar-brand" href="{{ route('homepage')}}">EventSS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <br>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-append">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='./searchLogged.html'">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </span>
          </div>

        </li>
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
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addFriend">Quaresma1997 wants to be your friend</a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#joinEvent">Quaresma1997 invited you to an event</a>
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