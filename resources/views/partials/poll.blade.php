<div class="container">
  <div class="col-8 offset-3">


    <div class="col-8 ">
      <h5><small class="text-muted">{{$poll->date}}</small></h5>

      <p><h5>{{$poll->question}}</h5></p>
    </div>

  
  

   <form action ="{{route('votea', $poll->id )}}" method="post"  >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach($poll->options as $option)
            @if(Auth::user()->getOption($poll->id)== $option->id)
            <div class="custom-control custom-radio">
              <input type="radio" name="option" id="{{$option->id}}" value="{{$option->id}}" class="custom-control-input" checked>
               <label class="custom-control-label" for="{{$option->id}}">{{$option->description}}</label>
                  <strong class="text-muted"> {{$poll->countVotes($option->id)}} Votes</strong>
                  </div>
                  

            @else
            <div class="custom-control custom-radio mt-1">
              <input type="radio" name="option" id="{{$option->id}}" value="{{$option->id}}" class="custom-control-input">
               <label class="custom-control-label" for="{{$option->id}}">{{$option->description}}</label>
                  <strong class="text-muted"> {{$poll->countVotes($option->id)}} Votes</strong>
                  </div>



            @endif
            
    
            @endforeach
           

            <button type="submit" class="btn btn-primary mt-4">
            <i class="fas fa-check-square"></i> Vote </button>     
          </form>     
         
  </div>
</div>
<hr>
