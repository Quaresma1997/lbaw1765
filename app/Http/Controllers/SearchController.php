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
        $query=strtolower($req -> get('query'));
        $query2=strtoupper($req -> get('query'));

               // DB::statement('ALTER TABLE events ADD FULLTEXT event (name)');
      //  $events=Event::whereRaw("MATCH(name) AGAINST(?)",array($search))->get();
      //$events= Event::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)",array($query))->get();
       //$users= User::search($query)->raw(); 
     // $users = User::search('"$query"')->get();

        $users = User::where ('username', 'LIKE', "%$query%")->orWhere('username', 'LIKE', "%$query2%")->orWhere('email', 'LIKE', "%$query%")->orderBy('username','asc')->get();
        // $users = User::where ('username', 'LIKE', "%$query%")->orWhere('username', 'LIKE', "%$query2%")->orWhere('email', 'LIKE', "%$query%")->orderBy('username','desc')->get();

       $events = Event::where('name', 'LIKE', "%$query%")->orWhere('name', 'LIKE', "%$query2%")-> where('is_public','=', 'true') ->get();

       $ev1 = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',1)->orderBy('date','asc')->get();
       $ev2 = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',2) ->get();
        $ev3 = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',3) ->get();
        $ev4 = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',4) ->get();
        $ev5 = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',5) ->get();
        $ev6 = Event::where('name', 'LIKE', "%$query%") -> where('is_public','=', 'true')->where('category_id',6) ->get();
       /**  $ev1->orderBy('date','desc');
         $ev2->orderBy('date','desc');
         $ev3->orderBy('date','desc');
         $ev4->orderBy('date','desc');
         $ev5->orderBy('date','desc');
         $ev6->orderBy('date','desc');
         $events->orderBy('date','desc');
*/

        return view('pages.search',compact('users','events','categories','ev1','ev2','ev3','ev4','ev5','ev6'));

        
    }



    
    
}
