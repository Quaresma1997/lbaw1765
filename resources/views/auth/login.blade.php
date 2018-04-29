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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="jumbotron">
  <h3 class="title">Login</h3> 
  <div class="container">

    <div class="row">
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
                  <!-- @if ($errors->has('username'))
                      <span class="error">
                          {{ $errors->first('username') }}
                      </span>
                  @endif -->
                </div>
                

            <label for="password" >Password</label>
          <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="password">
                      <i class="fas fa-lock fa-fw"></i>
                    </span>
                  </div>
                  <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
          <!-- @if ($errors->has('password'))
              <span class="error">
                  {{ $errors->first('password') }}
              </span>
          @endif -->
                </div>
              

                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>

                

                <hr>

        <button type="submit" class="btn btn-block btn-success mb-2">Login</button>

                

                <div class="btn-group d-flex" role="group">
                  <button type="button" class="btn btn-primary w-100" onclick="window.location.href='./admin.html'">
                    <i class="fab fa-facebook-f fa-fw"></i>
                  </button>
                  <button type="button" class="btn btn-danger w-100">
                    <i class="fab fa-google fa-fw"></i>
                  </button>
                  <button type="button" class="btn btn-secondary w-100">
                    <i class="fab fa-github fa-fw"></i>
                  </button>
                </div>
              </div>


          
      </form>
    </div>
  </div>
</div>
@endsection
