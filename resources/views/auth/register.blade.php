@extends('layouts.app')

@section('navbar')
  @include('partials.navNotLoggedIn')
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
  <h3 class="title">Sign Up</h3> 
  <hr>
  <div class="container">
    <div class="row">
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
                  <!-- @if ($errors->has('username'))
                    <div class="error alert alert-danger ml-3">
                      <li>{{ $errors->first('username') }} </li>
                    </div>
                  @endif -->
          </div>

        

          <label for="email">Email</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="email">
                      <i class="fas fa-envelope fa-fw"></i>
                    </span>
                  </div>
                  <input id="email" type="email" name="email" placeholder="Email" required>
          <!-- @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
          @endif -->
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
          <!-- @if ($errors->has('first_name'))
            <span class="error">
                {{ $errors->first('first_name') }}
            </span>
          @endif -->
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
          <!-- @if ($errors->has('last_name'))
            <span class="error">
                {{ $errors->first('last_name') }}
            </span>
          @endif -->
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
                      @foreach($countries->all() as $country){
                        @if($country->id == 1)
                        <option value = '{{$country->name}}' selected>{{$country->name}}</option>
                        @else
                        <option value = '{{$country->name}}'>{{$country->name}}</option>
                        @endif
                      }
                      @endforeach
                      <option value = 'Other'>Other</option>
                      </select>
          <!-- @if ($errors->has('country'))
            <span class="error">
                {{ $errors->first('country') }}
            </span>
          @endif -->
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
                      <select class = 'custom-select' id = 'select_city' name = 'city'>
                      @foreach($cities->all() as $city){
                        @if($city->id == 1)
                        <option value = '{{$city->name}}' selected>{{$city->name}}</option>
                        @else
                        <option value = '{{$city->name}}'>{{$city->name}}</option>
                        @endif
                      }
                      @endforeach
                      <option value = 'Other'>Other</option>
                      </select>
          <!-- @if ($errors->has('city'))
            <span class="error">
                {{ $errors->first('city') }}
            </span>
          @endif -->
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
                      <input id="password" type="password" name="password" placeholder="Enter password" required>
          <!-- @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif -->
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

      <button type="submit" class="btn btn-block btn-success mb-2" id="btn_signUp">Sign Up</button>
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
    </div>
  </div>
</div>
@endsection
