@extends('layouts.app')

@section('navbar')
<a class="navbar-brand" href="{{ route('index') }}">EventSS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      
      <ul class="navbar-nav ml-auto">
      <li class="navbar-item">
      <a class="nav-link" href="{{route('login')}}">
            <i class="fas fa-sign-in-alt fa-fw"></i> Login </a>
        </li>
        
      </ul>
    </div>
    </div>
  
@endsection

@section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <label for="username">Username</label>
     <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="username">
                <i class="fas fa-user fa-fw"></i>
              </span>
            </div>
            <input id="username" type="text" name="username" placeholder="Username" required autofocus>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif
          </div>

   

    <label for="email">Email</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="email">
                <i class="fas fa-envelope fa-fw"></i>
              </span>
            </div>
            <input id="email" type="email" name="email" placeholder="Email" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif
          </div>

          <div class="row">
            <div class="col-12 col-sm-6">
              <label for="first_name">First Name</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="first">
                    <i class="fas fa-id-card fa-fw"></i>
                  </span>
                </div>
                <input id="first_name" type="text" name="first_name" placeholder="Enter first name" required>
    @if ($errors->has('first_name'))
      <span class="error">
          {{ $errors->first('first_name') }}
      </span>
    @endif
              </div>
            </div>
          
            <div class="col-12 col-sm-6">
              <label for="last_name">Last Name</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="last">
                    <i class="fas fa-id-card fa-fw"></i>
                  </span>
                </div>
                <input id="last_name" type="text" name="last_name" placeholder="Enter last name" required>
    @if ($errors->has('last_name'))
      <span class="error">
          {{ $errors->first('last_name') }}
      </span>
    @endif
              </div>
            </div>
          </div>

           <div class="row">
             <div class="col-12 col-sm-6">
              <label for="country">Country</label>
              <div class="input-group mb-2 p-0 m-0">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="country">
                    <i class="fas fa-home fa-fw"></i>
                  </span>
                </div>
                <input id="country" type="text" name="country" placeholder="Enter country" required>
    @if ($errors->has('country'))
      <span class="error">
          {{ $errors->first('country') }}
      </span>
    @endif
              </div>
            </div>

            
            <div class="col-12 col-sm-6">
              <label for="city">City</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="city">
                    <i class="fas fa-home fa-fw"></i>
                  </span>
                </div>
                <input id="city" type="text" name="city" placeholder="Enter city" required>
    @if ($errors->has('city'))
      <span class="error">
          {{ $errors->first('city') }}
      </span>
    @endif
              </div>
            </div>
          </div>

              <label for="image_path">Image</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="image_path">
                    <i class="fas fa-home fa-fw"></i>
                  </span>
                </div>
                <input id="image_path" type="text" name="image_path" placeholder="Enter image_path" required>
    @if ($errors->has('image_path'))
      <span class="error">
          {{ $errors->first('image_path') }}
      </span>
    @endif
    </div>
    



          <div class="row">
            <div class="col-12 col-sm-6">
              <label for="password">Password</label>
              <div class="input-group mb-2 p-0 m-0">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="password">
                    <i class="fas fa-lock fa-fw"></i>
                  </span>
                </div>
                <input id="password" type="password" name="password" placeholder="Enter password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif
              </div>
            </div>

            <div class="col-12 col-sm-6">
              <label for="password-confirm">Confirm Password</label>
              <div class="input-group mb-2 p-0 m-0">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="password-confirm">
                    <i class="fas fa-lock fa-fw"></i>
                  </span>
                </div>
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password" required>
              </div>
            </div>
          </div>

      <hr>

<button type="submit" class="btn btn-block btn-success mb-2">Sign Up</button>

<div class="btn-group d-flex" role="group">
  <button type="button" class="btn btn-primary w-100">
    <i class="fab fa-facebook-f fa-fw"></i>
  </button>
  <button type="button" class="btn btn-danger w-100">
    <i class="fab fa-google fa-fw"></i>
  </button>
  <button type="button" class="btn btn-secondary w-100">
    <i class="fab fa-github fa-fw"></i>
  </button>
</div>

  
</form>
@endsection
