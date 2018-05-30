<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Friendship;

class FriendshipController extends Controller
{
    private function valid(Request $data)
    {
    $user1 = $data->input('user1');
    $user2 = $data->input('user2');
      return Validator::make($data->all(), [
        'user1' => 'unique:friendships,user_id_1,NULL,id,user_id_2,' . $user2,
        'user2' => 'unique:friendships,user_id_2,NULL,id,user_id_1,' . $user1,
      ]);
    }

    public function delete(Request $request){
        
        $user1 = $request->input('user1');
        $user2 = $request->input('user2');
        $friendship = Friendship::where('user_id_1', $user1)->where('user_id_2', $user2)->first();
        if($friendship == null)
            $friendship = Friendship::where('user_id_2', $user1)->where('user_id_1', $user2)->first();

        $this->authorize('delete', $friendship);
        
        if($user1 == Auth::user()->id)
            $redirect_id = $user2;
        else
            $redirect_id = $user1;


        if($friendship->delete()){        
            return response()->json(['message' => 'success', 'id' => $redirect_id]);
        }
        else
            return response()->json(['message' => 'Error deleting friendship!']);  

    }
}
