<div data-id="{{ $post->id }}">
  <div class="container">
    <div class="row">
      <div class="col-3 offset-2 col-md-2 col-lg-1">
        <a href="/profile/{{$post->user_id}}" class="text-white" >
          <img src="{{url('/imgs/' . $post->user->image_path)}}" class="rounded-circle userPostImg" alt="User image">
        </a>
      </div>
      <div class="col-7">
        <h5>
          <a href="/profile/{{$post->user_id}}" class="text-white">{{$post->user->username}} </a>
          <br>
          <small class="text-muted"> {{$post->date}}</small>
        </h5>
      </div>
      <div class="col-8 offset-3" data-route="{{route('postupdate', $post->id )}}">
        <p>{{$post->description}}</p>
        
        
        @if(!is_null($post->image_path ))
        <div class="col-8 offset-1" id="post_image">
          <img src="/post_images/{{$post->image_path}}" id="img" data-img-name="{{$post->image_path}}" class="eventPostImg" alt="Event image">
        </div>
        @endif

        
@if(Auth::check())
        @if($post->user->id == Auth::user()->id || $post->event->owner_id ==Auth::user()->id)
        <form action ="{{route('postd', $post->id )}}" method ="post" >
          {{ csrf_field() }}
          <input type="hidden" name="_method" value ="DELETE" > </input>
          <button type="submit" class="btn btn-outline-danger mx-1 float-right" name="btn_deletePost">
            <i class="fas fa-trash-alt fa-fw"></i> Delete </button>
            @endif
          </form>
          @if($post->user->id == Auth::user()->id)
          <button type="button" class="btn btn-primary mx-1 float-right" id="btn_editPost">
           <i class="far fa-edit fa-fw"></i> Edit </button>
           @endif
@endif
           
         </div>
       </div>
       <hr>
     </div>
   </div>

