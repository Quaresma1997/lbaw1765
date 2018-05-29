
<a class="navbar-brand" href="{{ route('index')}}">EventSS</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
  <br>
 <form action ="{{route('search')}}" id="search_form" method="get" class="form-inline">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <div class="input-group">
          <input type="text" class="form-control" name="query" placeholder="Search" id="search_field">
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
      <a class="nav-link" href="{{route('register')}}">
          <i class="fas fa-user fa-fw"></i> Sign Up </a>
        </li>
        <li class="navbar-item">
          <a class="nav-link" href="{{route('login')}}">
              <i class="fas fa-sign-in-alt fa-fw"></i> Login </a>
            </li>
          </ul>
        </div>