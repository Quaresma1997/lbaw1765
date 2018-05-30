<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\User;
use App\Event;
use App\Category;

class SearchController extends Controller
{
    //

    public function index(Request $req){

        $categories = Category::all();   
        $search=[];
        $query=$req -> get('query');

        $users = User::where ('username', 'ILIKE', "%$query%")->orWhere('email', 'ILIKE', "%$query%")->orderBy('username','asc')->get();

       $events = Event::where('name', 'ILIKE', "%$query%")-> where('is_public','=', 'true') ->get();

       $ev1 = Event::where('name', 'ILIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',1)->orderBy('date','asc')->get();
       $ev2 = Event::where('name', 'ILIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',2) ->get();
        $ev3 = Event::where('name', 'ILIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',3) ->get();
        $ev4 = Event::where('name', 'ILIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',4) ->get();
        $ev5 = Event::where('name', 'ILIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',5) ->get();
        $ev6 = Event::where('name', 'ILIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',6) ->get();

        return view('pages.search',compact('users','events','categories','ev1','ev2','ev3','ev4','ev5','ev6'));

        
    }



    
    
}
