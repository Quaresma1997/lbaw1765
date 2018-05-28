<div class "container">
<div class="col-8 offset-3">


          <div class="col-8 ">
          <small class="text-muted"> {{$poll->date}}</small>

          <p><h5>{{$poll->question}}</p>            </h5>
          </div>


 @foreach($poll->options as $option)
 <div class="custom-control custom-radio mb-1">
              <input type="radio" id="{{$option->id}}" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="{{$option->id}}">{{$option->description}}</label>
            </div>
      @endforeach

            
                     </div>

             
          </div>
        <hr>
