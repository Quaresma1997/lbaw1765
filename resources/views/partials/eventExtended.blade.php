<div class="col-12 col-lg-6 p-2">
  <div class="jumbotron list content-lg p-0 m-0">
    <div class="row p-2">
      <div class="col-1">
        <a href="/profile/{{$event->participant->user->id}}" class="text-white">
          <img src="{{url('/imgs/' . $event->participant->user->image_path)}}" class="rounded-circle userFeedImg">
        </a>
      </div>
      <div class="col-11">
        <h5>
          <a href="/profile/{{$event->participant->user->id}}" class="text-white">{{$event->participant->user->username}}</a> joined
          <a href="/events/{{$event->id}}" class="text-white">{{$event->name}}</a>
        </h5>
      </div>
      <div class="col-12 mt-2">
        <a href="/events/{{$event->id}}" class="text-white">
          <img src="{{url('/imgs/' .  $event->images->last()->path)}}" class="eventHomepageImg rounded">
        </a>
      </div>
    </div>
  </div>
</div>
