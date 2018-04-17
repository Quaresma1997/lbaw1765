
<a class="navbar-brand" href="{{ route('index')}}">EventSS</a>
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
              <button type="button" class="btn btn-secondary" onclick="window.location.href='./search.html'">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </span>
          </div>

        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="{{route('register')}}">
          <!-- <a class="nav-link" href="#" data-toggle="modal" data-target="#sign_up"> -->
            <i class="fas fa-user fa-fw"></i> Sign Up </a>
        </li>
        <li class="navbar-item">
        <a class="nav-link" href="{{route('login')}}">
          <!-- <a class="nav-link" href="#" data-toggle="modal" data-target="#login"> -->
            <i class="fas fa-sign-in-alt fa-fw"></i> Login </a>
        </li>
      </ul>
    </div>
    </div>

  

  