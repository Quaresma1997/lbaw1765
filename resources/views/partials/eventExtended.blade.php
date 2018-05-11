<div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="/events/{{$event->id}}" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp1.jpg')}}">
                  <div class="content-details">
                    <h3>{{$event->name}}</h3>
                    <p>{{$event->date}}
                      <br> {{$event->localization->city->name}}, {{$event->localization->city->country->name}}</p>
                  </div>
                </a>
              </div>
            </div>