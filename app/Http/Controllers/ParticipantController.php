<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Participant;

class ParticipantController extends Controller
{
    private function valid(Request $data)
    {
    $event_id = $data->input('event_id');
    $user_id = $data->input('user_id');
      return Validator::make($data->all(), [
        'user_id' => 'unique:participants,user_id,NULL,id,event_id,' . $event_id,
        'event_id' => 'unique:participants,event_id,NULL,id,user_id,' . $user_id,
      ]);
    }

    public function delete(Request $request){
        
        $event_id = $request->input('event_id');
        $user_id = $request->input('user_id');
        $participant = Participant::where('event_id', $event_id)->where('user_id', $user_id)->first();

        $owner = $participant->event->owner;

        $this->authorize('delete', Auth::user(), $participant, $owner);


        if($participant->delete()){        
            return response()->json(['message' => 'success', 'success' => 'Participation removed', 'id' => $request->input('event_id')]);
        }
        else
            return response()->json(['message' => 'error', 'error' => 'Error deleting participation!']);  

    }

    public function create(Request $request){
        $validated = $this->valid($request);
        if(!$validated->passes())
            return response()->json(['message' => 'errors', 'error' => $validated->errors()->all()]);

        $participant = new Participant();

        $this->authorize('create', $participant);

        $participant->event_id = $request->input('event_id');
        $participant->user_id = $request->input('user_id');

        $participant->save();

        return response()->json(['message' => 'success', 'success' => 'Participation added', 'id' => $request->input('event_id')]);
    }
}
