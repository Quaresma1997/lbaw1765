@extends('layouts.app')

@section('navbar')
<a class="navbar-brand" href="{{ route('index') }}">EventSS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">
            <i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
        
      </ul>
    </div>
    </div>
@endsection



@section('content')

<div class="offset">
<div class="jumbotron container" id="jumbotron_register">
  <h3 class="title" style="display: inline;">Sign Up</h3> 
  <div class="popup float-right" onclick="showPopup()">
    <i class="fas fa-info-circle fa-lg"></i>
      <span class="popupregist" id="myPopup">
      Username: Length between 1 and 30
      <br>
      Email: Email will be used to contact if needed
      <br>
      Country: Select "Other" if your option isn't in the list
      <br>
      City: Select "Other" if your option isn't in the list
      <br>
      Password: At least 6 chars, 3 letters and 1 number
      </span>
    </div>
  <hr>
      <form method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <label for="username">Username</label>
          <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="username">
                      <i class="fas fa-user fa-fw"></i>
                    </span>
                  </div>
                  <input id="username" class="form-control" type="text" name="username" placeholder="Username" required autofocus>

          </div>

        

          <label for="email">Email</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="email">
                      <i class="fas fa-envelope fa-fw"></i>
                    </span>
                  </div>
                  <input id="email" class="form-control" type="email" name="email" placeholder="Email" required>

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
                      <input id="first_name" type="text" class="form-control" name="first_name" placeholder="Enter first name" required>

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
                      <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Enter last name" required>

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
                        <select class = 'custom-select' id = 'select_country' name = 'country'>
                        <option value = 'Other'>Other</option>
                        <option disabled>────────────────────</option>
                      @foreach($countries->all() as $country)
                        @if($country->id == 1)
                        <option value = '{{$country->name}}' selected >{{$country->name}}</option>
                        @else
                        <option value = '{{$country->name}}'>{{$country->name}}</option>
                        @endif
                      
                      @endforeach
                      </select>

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
                      <select class = 'custom-select' id = 'select_city' placeholder = "City" name = 'city' >
                      <option value = 'Other'>Other</option>
                      <option disabled>────────────────────</option>
                      @foreach($cities->all() as $city){
                        @if($city->id == 1)
                        <option value = '{{$city->name}}' selected>{{$city->name}}</option>
                        @else
                        <option value = '{{$city->name}}'>{{$city->name}}</option>
                        @endif
                      }
                      @endforeach
                      </select>

                    </div>
                
                  </div>
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
                      <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" required>
         
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
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                    </div>
                  </div>
                </div>

            <hr>

      <button type="submit" class="btn btn-block btn-success mb-2" id="btn_signUp">Sign Up</button>
      <div class="btn-group d-flex" role="group">
        <button type="button" onclick="location.href='/auth/twitter'" class="btn btn-info w-100">
                    <i class="fab fa-twitter fa-fw"></i>
                  </button>
                  <button type="button" onclick="location.href='/auth/google'" class="btn btn-danger w-100">
                    <i class="fab fa-google fa-fw"></i>
                  </button>
                  <button type="button" onclick="location.href='/auth/github'" class="btn btn-secondary w-100">
                    <i class="fab fa-github fa-fw"></i>
                  </button>
      </div> 
      </form>
</div>
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
