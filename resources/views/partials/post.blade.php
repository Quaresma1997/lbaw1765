<div class "container">
        <div class="row">
          <div class="col-3 offset-2 col-md-2 col-lg-1">
            <a href="/profile/{{$post->user_id}}" class="text-white" >
              <img src="{{$post->user->image_path}}" class="rounded-circle">
            </a>
          </div>
          <div class="col-7">
            <h5>
              <a href="/profile/{{$post->user_id}}" class="text-white">{{$post->user->username}} </a>
              <br>
              <small class="text-muted"> {{$post->date}}</small>
            </h5>
          </div>
          <div class="col-8 offset-2">
          {{$post->description}}
            <p>
            
              <a class="text-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="ion-reply"></i>
                <strong> Comments </strong>
              </a>
              <a href=# class="text-primary float-right mx-1">
                <strong> Delete </strong>
              </a>
              <a href=# class="text-primary float-right mx-1">
                <strong> Edit </strong>
              </a>
            </p>
          </div>
        </div>
        <hr>
        </div>
