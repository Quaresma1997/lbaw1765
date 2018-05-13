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
       // $query = Input::get('query');

        $users = User::where ('username', 'LIKE', "%$query%")->get();

        $events = Event::where('name', 'LIKE', "%$query%")->get();


        return view('pages.search',compact('users','events'));

        
    }

    /**
     --> search user
SELECT username, email, image_path
FROM users
WHERE username LIKE %$search% OR email LIKE %$search%
ORDER BY username; 

--> search event
SELECT id, "name", "date", localization, category
FROM events
WHERE "name" LIKE %$search% OR localization LIKE %$search% AND event_type = 'public'
ORDER BY "name";


     
     */

    public function show()
    {
    }

    
    
}
