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
       // DB::statement('ALTER TABLE events ADD FULLTEXT event (name)');

        $query=$req -> get('query');

      //  $events=Event::whereRaw("MATCH(name) AGAINST(?)",array($search))->get();

     // $users = User::search('"$query"')->get();

        $users = User::where ('username', 'LIKE', "%$query%")->orWhere('email', 'LIKE', "%$query%")->get();
       //$users= User::search($query)->raw(); 
       $events = $query::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true') ->get();

      //$events= Event::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)",array($query))->get();
      
        return view('pages.search',compact('users','events','categories'));

        
    }



    
    
}
