<div class="jumbotron jumbotron-fluid p-1 my-1 list col-6">
    <a href="/events/{{$event->id}}" class="text-white">
        <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="{{url('/imgs/pyra.jpg')}}">
                          @if($event->done == null)
                            Future
                          @else
                            Past
                          @endif
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