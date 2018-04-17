<div class="modal fade" id="login">
    <div class="modal-dialog modal-dialog-centered modal-md">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body ">

            <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    
    <label for="username">Username</label>
    <input id="username" type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            @if ($errors->has('username'))
                <span class="error">
                    {{ $errors->first('username') }}
                </span>
            @endif
          

      <label for="password" >Password</label>
    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif
         

          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
          </label>

          

          <hr>

           <div class="btn-group d-flex mb-2" role="group">
          <button class="btn btn-success w-100" type="submit">Login</button>
          <button type="button" class="btn w-100" type="submit">Register</button>
            </div>

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
  </div>