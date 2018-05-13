<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\EventInvite;

class EventInviteController extends Controller
{
    private function valid(Request $data)
    {
    $event = $data->input('event_id');
    $receiver = $data->input('receiver');
      return Validator::make($data->all(), [
        'event' => 'unique:event_invites,event_id,NULL,id,receiver_id,' . $receiver,
        'receiver' => 'unique:event_invites,receiver_id,NULL,id,event_id,' . $event,
      ]);
    }

    public function delete(Request $request){
        
        $event = $request->input('event_id');
        $receiver = $request->input('receiver');
        $event_invite = EventInvite::where('event_id', $event)->where('receiver_id', $receiver)->first();

        if($event_invite == null)
            return response()->json(['message' => 'error', 'error' => 'Error deleting event invite!']);

        $owner = $event_invite->event->owner;

        $this->authorize('delete', Auth::user(), $event_invite,  $owner);


        if($event_invite->delete()){        
            return response()->json(['message' => 'success', 'currentInvite' => $request->input('currentInvite')]);
        }
        else
            return response()->json(['message' => 'error', 'error' => 'Error deleting event invite!']);  

    }

    public function create(Request $request){
        $validated = $this->valid($request);
        if(!$validated->passes())
            return response()->json(['message' => $validated->errors()->all()]);

        $event_invite = new EventInvite();

        $this->authorize('create', $event_invite);

        $event_invite->event_id = $request->input('event_id');
        $event_invite->receiver_id = $request->input('receiver');
        $event_invite->sender_id = $request->input('sender');

        $event_invite->save();

        return response()->json(['message' => 'success', 'currentInvite' => $request->input('currentInvite')]);
    }

    public function update(Request $request){
        $event = $request->input('event_id');
        $receiver = $request->input('receiver');
        $event_invite = EventInvite::where('event_id', $event)->where('receiver_id', $receiver)->first();

        $this->authorize('update', $event_invite);

        
        $event_invite->answer = $request->input('answer');
        $event_invite->save();

        return response()->json(['message' => 'success', 'id' => $event]);
    }
}
