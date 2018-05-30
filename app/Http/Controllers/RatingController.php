<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rating;
use App\Event;

class RatingController extends Controller
{
    private function valid(Request $data)
    {
    $user_id = $data->input('user_id');
    $event_id = $data->input('event_id');
      return Validator::make($data->all(), [
        'user_id' => 'unique:ratings,user_id,NULL,id,event_id,' . $event_id,
        'event_id' => 'unique:ratings,event_id,NULL,id,user_id,' . $user_id,
      ]);
    }

    public function create(Request $request){
        $validated = $this->valid($request);
        if(!$validated->passes())
            return response()->json(['message' => $validated->errors()->all()]);

        $rating = new Rating();

        // $this->authorize('create', $rating);

        $rating->event_id = $request->input('event_id');
        $rating->user_id = $request->input('user_id');
        $rating->value = $request->input('new_value');

        $rating->save();

        $event_avg = Event::find($request->input('event_id'))->done->rating;
        $num_rates = count(Rating::where('event_id', $request->input('event_id'))->get()) - 1;

        $avg = (($event_avg * $num_rates) + $request->input('new_value')) / ($num_rates + 1);

        return response()->json(['message' => 'success', 'avg' => round($avg,1), 'vote' => $request->input('new_value')]);
    }

    public function update(Request $request){
        $event_id = $request->input('event_id');
        $user_id = $request->input('user_id');
        $rating = Rating::where('event_id', $event_id)->where('user_id', $user_id)->first();

        // $this->authorize('update', $rating);

        
        $rating->value = $request->input('new_value');
        $rating->save();

        $event = Event::find($event_id);

        $event_avg = Event::find($request->input('event_id'))->done->rating;
        $num_rates = count(Rating::where('event_id', $request->input('event_id'))->get()) - 1;

        $avg = (($event_avg * $num_rates) + $request->input('new_value')) / ($num_rates + 1);

        return response()->json(['message' => 'success', 'avg' => round($avg,1), 'vote' => $request->input('new_value')]);
    }

      
}
