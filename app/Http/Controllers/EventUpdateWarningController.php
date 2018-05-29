<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EventUpdateWarning;

class EventUpdateWarningController extends Controller
{
    public function delete(Request $request, $id){
        $not = EventUpdateWarning::find($id);
        if($not == null)
            return response()->json(['message' => 'Error deleting event update warning']);
        
        if($not->delete()){        
            return response()->json(['message' => 'success', 'current_not' => $request->input('current_not')]);
        }
        else
            return response()->json(['message' => 'Error deleting event update warning']); 
    }
}
