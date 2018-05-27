<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EventDeleteWarning;

class EventDeleteWarningController extends Controller
{
    public function delete(Request $request, $id){
        $not = EventDeleteWarning::find($id);
        if($not == null)
            return response()->json(['message' => 'error', 'error' => 'Error deleting event delete warning!']);
        
        if($not->delete()){        
            return response()->json(['message' => 'success', 'current_not' => $request->input('current_not')]);
        }
        else
            return response()->json(['message' => 'error', 'error' => 'Error deleting event delete warning!']); 
    }
}
