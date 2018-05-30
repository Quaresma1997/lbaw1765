<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Event;

class AdminController extends Controller
{
    //

    public function show()
    {
        return view('pages.admin', ['users' => User::all()->except(Auth::id())->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE),
        'events' => Event::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)]);
    }

    public function delete(Request $request, $username){
        $user = User::where('username', $username)->first();

        $email = $user->email;

        $this->authorize('delete', $user);

        if($user->delete()){
            DB::table('baned_users')->insert([
                ['email' => $email]]
            );
         
         
            return response()->json(['message' => 'success']);

        }
        else
            return response()->json(['message' => 'Error banning user!']);

    }

    public function searchUsers(Request $request){

        $query=$request -> get('query');

        $users = User::where ('username', 'ILIKE', "%$query%")->orWhere('email', 'ILIKE', "%$query%")->orderBy('username','asc')->get();
        return view('pages.admin', ['users' => $users,'events' => Event::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)]);

        

    }
    public function searchEvents(Request $request){

        $query=$request -> get('query');

        $events = Event::where('name', 'ILIKE', "%$query%")->orderBy('name','asc')->get();
        return view('pages.admin', ['users' => User::all()->except(Auth::id())->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE),'events' => $events]);

        

    }
    
}
