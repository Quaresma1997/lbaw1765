<div class="container" style="margin-top:10em">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php $i = 0; ?>
          @foreach($event->images as $image)
            @if($i == 0)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
            @else
              <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
            @endif            
            <?php $i++; ?>
          @endforeach
      </ol>
      <div class="carousel-inner" role="listbox">
      <?php $i = 0; ?>
        @foreach($event->images as $image)
          @if($i == 0)
            <div class="carousel-item active">
          @else
            <div class="carousel-item">
          @endif
          <?php $i++; ?>
            <img class="d-block img-fluid" src="{{url('/imgs/'.$image->path)}}" alt="Image {{$image->path}}">
          </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    
    <div class="jumbotron" >
      <div class="row" style="display:grid;">
      <div class="flex">

      @if(Auth::check())
        @if($event->done == null)
      <button type="button" class="btn btn-success mx-1 float-right" id="btn_addParticipation" event-id="{{$event->id}}" user-id="{{Auth::user()->id}}">
        <i class="fas fa-check fa-fw"></i> Join Event </button>
      @endif
      @endif
      <button type="button" class="btn btn-secondary mx-1 float-right" data-toggle="modal" data-target="#participants">
        <i class="fas fa-clipboard-list fa-fw"></i> Participants </button>
      @if($event->done != null)
         <div class="float-right mr-3">
        
        <fieldset id="star_rating" class="rating float-right mr-3" data-id="{{$event->done->rating}}" disabled>
    <input type="radio" id="star5" name="rating" value="5" disabled/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrible - 1 star"></label>
</fieldset>
<br>
  <span id = "avg_rating"> 
    @if($event->done->rating == null)
    This event has no rating!
    @else
    Avg rating is {{$event->done->rating}}/5
  @endif</span>
  </div>
      @endif
      <br>
      <br>
      </div>
      </div>
      <hr>
       @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
      <div id="event_data" data-id="{{ $event->id }}">
       <span class="display-4" id="event_name">{{$event->name}}</span>
      <span id="event_public" data-id="{{$event->is_public}}">
      @if($event->is_public)
       (Public) 
      @else 
      (Private) 
      @endif</span>
      @if($event->done != null)
        <span class="display-4">Past event</span>
      @endif
      <br>
      <div class="row mt-5">
        <div class="col-12 col-lg-5">
          <h5 id="event_date">
            <i class="fas fa-clock fa-fw mr-1" ></i>{{$event->date}} at {{$event->time}}</h5>
          <h5 id="event_localization">
            <i class="fas fa-map-marker-alt fa-fw mr-1"></i>{{$event->place}}, {{$event->city}}, {{$event->country}} </h5>
            <h5 id="address"> 
            {{$event->address}}</h5>
          <h5 id="event_category" data-id="{{ $event->category_id }}">
            Category: {{$event->category->name}}</h5>
          <br>
         <!--  <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12012.041648923578!2d-8.5976876!3d41.1779401!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x405225b4b451f7d7!2sFEUP+-+Faculdade+de+Engenharia+da+Universidade+do+Porto!5e0!3m2!1spt-PT!2spt!4v1520958961221"
              frameborder="0" allowfullscreen></iframe>
          </div> -->
        </div>
        <div class="col-12 col-lg-7">
          <h1>Description</h1>
          <br>
          <p id="event_description">
          {{$event->description}}
          </p>
        </div>
      </div>
    </div>
    </div>

<div class="jumbotron" >
      <h2 class="display-4">Discussion</h2>
      <br>
      <hr>

         @each('partials.post', $event->posts, 'post')
     
        </div>
      </div>
    </div>
  </div>