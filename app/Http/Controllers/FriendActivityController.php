<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\FriendActivity;

class FriendActivityController extends Controller
{
    private function valid(Request $data)
    {
    $sender = $data->input('sender');
    $event = $data->input('event');
      return Validator::make($data->all(), [
        'sender' => 'unique:friend_activites,sender_id,NULL,id,event_id' . $event,
        'event' => 'unique:friend_activites,receiver_id,NULL,id,sender_id,' . $sender,
      ]);
    }

    public function delete(Request $request){
        
        $sender = $request->input('sender');
        $receiver = $data->input('receiver');
        $friend_request = FriendActivity::where('sender_id', $sender)->where('receiver_id', $receiver)->first();


        $this->authorize('delete', $friend_request);


        if($friend_request->delete()){        
            return response()->json(['message' => 'success']);
        }
        else
            return response()->json(['message' => 'error', 'error' => 'Error deleting friend request!']);  

    }

    public function create(Request $request){
        $validated = $this->valid($request);
        if(!$validated->passes())
            return response()->json(['message' => $validated->errors()->all()]);

        $friend_request = new FriendActivity();

        $this->authorize('create', $friend_request);

        $friend_request->receiver_id = $request->input('receiver');
        $friend_request->sender_id = $request->input('sender');

        $friend_request->save();

        return response()->json(['message' => 'success', 'id' => $request->input('receiver')]);
    }

    public function update(Request $request){
        $sender = $request->input('sender');
        $receiver = $request->input('receiver');
        $friend_request = FriendActivity::where('sender_id', $sender)->where('receiver_id', $receiver)->first();

        $this->authorize('update', $friend_request);

        
        $friend_request->answer = $request->input('answer');
        $friend_request->save();

        return response()->json(['message' => 'success', 'id' => $sender]);
    }
}
