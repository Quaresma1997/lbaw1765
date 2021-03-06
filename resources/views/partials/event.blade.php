<div class="col-12 col-lg-6 px-1" data-name-div="search_event" data-id="{{$event->category_id}}" data-date="{{$event->date}}" data-name="{{$event->name}}" >
<div class="jumbotron jumbotron-fluid p-1 my-1 list">
  <a href="/events/{{$event->id}}" class="text-white">
    <div class="row">
      <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
        <img class="rounded eventSearchImg" src="{{url('/imgs/' .  $event->images->last()->path)}}" alt="Event image">
      </div>
      <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
        <div class="my-1">
          <h4>{{$event->name}}
            @if(Auth::check())
            @if(Auth::user()->id == $event->owner_id)
            (Owner)
            @endif
          @endif</h4>
          <p>{{$event->date}}
            <br> {{$event->localization->city->name}}, {{$event->localization->city->country->name}}</p>
          </div>
        </div>
      </div>
    </a>
  </div>
  </div>