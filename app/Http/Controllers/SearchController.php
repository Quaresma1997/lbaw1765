<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Event;

class SearchController extends Controller
{
    //

    public function index(Request $req){

        $query=$req -> get('query');

        $users = User::where ('username', 'LIKE', "%$query%")->orWhere('email', 'LIKE', "%$query%")->get();
        $events = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true') ->get();

        return view('pages.search',compact('users','events'));

        
    }



    
    
}
