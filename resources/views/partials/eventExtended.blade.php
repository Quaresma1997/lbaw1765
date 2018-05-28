<div class="col-12 col-lg-6">
  <div class="jumbotron list content-lg p-0 mx-auto">
    <div class="row p-2">
      <div class="col-2">
        <a href="/profile/{{$event->participant->user->id}}" class="text-white">
          <img src="{{url('/imgs/' . $event->participant->user->image_path)}}" height="42" width="42" class="rounded-circle">
        </a>
      </div>
      <div class="col-7">
        <h5>
          <a href="/profile/{{$event->participant->user->id}}" class="text-white">{{$event->participant->user->username}}</a> joined
          <a href="/events/{{$event->id}}" class="text-white">{{$event->name}}</a>
        </h5>
      </div>
      <div class="col-12 mt-2">
        <a href="/events/{{$event->id}}" class="text-white">
          <img src="{{url('/imgs/' .  $event->images->last()->path)}}" class="img-fluid rounded">
        </a>
      </div>
    </div>
  </div>
</div>
