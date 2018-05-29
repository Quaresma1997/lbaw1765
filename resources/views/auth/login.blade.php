@extends('layouts.app')

@section('navbar')
<a class="navbar-brand" href="{{ route('index') }}">EventSS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="{{route('register')}}">
            <i class="fas fa-user fa-fw"></i> Sign Up </a>
        </li>
        
      </ul>
    </div>
    </div>
  
@endsection

@section('content')

<div class="jumbotron container" id="jumbotron_login" >
  <h3 class="title">Login</h3> 
  <hr>
      <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          
          <label for="username">Username</label>
          <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="username">
                      <i class="fas fa-user fa-fw"></i>
                    </span>
                  </div>
                  <input id="username" type="text" name="username" class="form-control" placeholder="Username" required autofocus>
     
                </div>
                

            <label for="password" >Password</label>
          <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="password">
                      <i class="fas fa-lock fa-fw"></i>
                    </span>
                  </div>
                  <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>

                </div>
              

                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>

                

                <hr>

                <button type="submit" class="btn btn-block btn-success mb-2">Login</button>

                
            
                <div class="btn-group d-flex" role="group">
                  <button type="button" onclick="location.href='/auth/twitter'" class="btn btn-primary w-100">
                    <i class="fab fa-twitter fa-fw"></i>
                  </button>
                  <button type="button" onclick="location.href='/auth/google'" class="btn btn-danger w-100">
                    <i class="fab fa-google fa-fw"></i>
                  </button>
                  <button type="button" onclick="location.href='/auth/github'" class="btn btn-secondary w-100">
                    <i class="fab fa-github fa-fw"></i>
                  </button>
                </div>
              </div>

      </form>
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
