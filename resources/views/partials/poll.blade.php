<div class="container">
  <div class="col-8 offset-3">


    <div class="col-8 ">
      <small class="text-muted"> {{$poll->date}}</small>

      <p><h5>{{$poll->question}}</p></h5>
    </div>

  

   <form action ="{{route('votea', $poll->id )}}" method="post"  >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach($poll->options as $option)
            @if(Auth::user()->getOption($poll->id)== $option->id)
              <input type="radio" name="option" id="{{$option->id}}" value="{{$option->id}}"> {{$option->description}}
                  <i class="fas fa-check-square"></i> 
                  @foreach($poll->poll_votes as $vote)
                  @endforeach
                  <strong class="text-muted"> {{$vote->countVotes($option->id)}} Votes</strong>
            @else
            <input type="radio" name="option" id="{{$option->id}}" value="{{$option->id}}"> {{$option->description}}
            @foreach($poll->poll_votes as $vote)
              @endforeach
              <strong class="text-muted"> {{$vote->countVotes($option->id)}} Votes</strong>

            @endif
            
            <br>
            @endforeach
            <br>

            <button type="submit" class="btn btn-primary ">
            <i class="fas fa-check-square"></i> Vote </button>     
          </form>   
      
    

  
<!--  ALterar para que deixe de aparecer form quando já votou -->
  
         
  </div>
</div>
<hr>
