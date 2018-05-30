<a class="navbar-brand" href="{{ route('admin')}}">EventSS</a>
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