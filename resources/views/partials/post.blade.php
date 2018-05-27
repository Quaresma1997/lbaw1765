<div id="post_data" data-id="{{ $post->id }}">
<div class "container">
        <div class="row">
          <div class="col-3 offset-2 col-md-2 col-lg-1">
            <a href="/profile/{{$post->user_id}}" class="text-white" >
              <img src="{{url('/imgs/' . $post->user->image_path)}}" height="42" width="42" class="rounded-circle">
            </a>
          </div>
          <div class="col-7">
            <h5>
              <a href="/profile/{{$post->user_id}}" class="text-white">{{$post->user->username}} </a>
              <br>
              <small class="text-muted"> {{$post->date}}</small>
            </h5>
          </div>
          <div class="col-8 offset-3">
          {{$post->description}}
            <p>
            <!--
              <a class="text-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="ion-reply"></i>
                <strong> Comments </strong>
              </a>

<button type="button" class="btn btn-outline-danger mx-1 float-right" id="btn_deletePost">
        <i class="fas fa-trash-alt fa-fw"></i> Delete </button>
              <a href="{{route('postd',$post->event_id)}}" > DELETE </a>

              -->
              @if(Auth::check())
                @if($post->user->id == Auth::user()->id || $post->event->owner_id ==Auth::user()->id)
                  <form action ="{{route('postd', $post->id )}}" method ="post" >
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value ="DELETE" > </input>
                  <button type="submit" class="btn btn-outline-danger mx-1 float-right" id="btn_deletePost">
                  <i class="fas fa-trash-alt fa-fw"></i> Delete </button>
              @endif

              @if($post->user->id == Auth::user()->id)
              <button type="button" class="btn btn-primary mx-1 float-right" id="btn_editPost">
          <i class="far fa-edit fa-fw"></i> Edit </button>
                @endif
              @endif

             
            </p>
          </div>
        </div>
        <hr>
        </div>
        </div>

