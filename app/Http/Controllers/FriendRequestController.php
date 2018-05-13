<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\FriendRequest;

class FriendRequestController extends Controller
{
    private function valid(Request $data)
    {
    $sender = $data->input('sender');
    $receiver = $data->input('receiver');
      return Validator::make($data->all(), [
        'sender' => 'unique:friend_requests,sender_id,NULL,id,receiver_id,' . $receiver,
        'receiver' => 'unique:friend_requests,receiver_id,NULL,id,sender_id,' . $sender,
      ]);
    }

    public function delete(Request $request){
        
        $sender = $request->input('sender');
        $receiver = $data->input('receiver');
        $friend_request = FriendRequest::where('sender_id', $sender)->where('receiver_id', $receiver)->first();


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

        $friend_request = new FriendRequest();

        $this->authorize('create', $friend_request);

        $friend_request->receiver_id = $request->input('receiver');
        $friend_request->sender_id = $request->input('sender');

        $friend_request->save();

        return response()->json(['message' => 'success', 'id' => $request->input('receiver')]);
    }

    public function update(Request $request){
        $sender = $request->input('sender');
        $receiver = $request->input('receiver');
        $friend_request = FriendRequest::where('sender_id', $sender)->where('receiver_id', $receiver)->first();

        $this->authorize('update', $friend_request);

        
        $friend_request->answer = $request->input('answer');
        $friend_request->save();

        return response()->json(['message' => 'success', 'id' => $sender]);
    }
}
