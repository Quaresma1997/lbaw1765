<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Event;
use App\Shortcut;

class ShortcutController extends Controller
{
    private function valid(Request $data)
    {
    $user_id = $data->input('user_id');
    $event_id = $data->input('event_id');
      return Validator::make($data->all(), [
        'user_id' => 'unique:shortcuts,user_id,NULL,id,event_id,' . $event_id,
        'event_id' => 'unique:shortcuts,event_id,NULL,id,user_id,' . $user_id,
      ]);
    }

    public function add(Request $request){   
        $validated = $this->valid($request);
        if(!$validated->passes())
            return response()->json(['message' => $validated->errors()->all()]);

        $shortcut = new Shortcut();

        $ev_id = $request->input('event_id');

        $shortcut->user_id = $request->input('user_id');
        $shortcut->event_id = $request->input('event_id');
        $shortcut->save();

        $event = Event::find($ev_id);

        return response()->json(['message' => 'success', 'id'=>$shortcut->id, 'event_id' => $request->input('event_id'), 'event_name' => $event->name]);
    }

     public function delete(Request $request,$id)
    {
        $shortcut = Shortcut::find($id);

        if($shortcut == null)
            return response()->json(['message' => 'Error deleting shortcut!']);       

       // dd($request);
          if($shortcut->delete()){        
            return response()->json(['message' => 'success', 'id'=>$shortcut->id, 'current_shortcut' => $request->input('current_shortcut'), 'event_id' => $shortcut->event->id, 'event_name' => $shortcut->event->name]);
        }
        else
            return response()->json(['message' => 'Error deleting event update warning!']); 

    }
}
