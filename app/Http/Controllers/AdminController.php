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
        return view('pages.admin', ['users' => User::all()->except(Auth::id()),'events' => Event::all()]);
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
        $users = User::where ('username', 'LIKE', "%$query%")->orWhere('email', 'LIKE', "%$query%")->get();
      // dd($query);
        return view('pages.admin', ['users' => $users,'events' => Event::all()]);

        

    }
    public function searchEvents(Request $request){

        $query=$request -> get('query');
        $events = Event::where('name', 'LIKE', "%$query%")-> where('is_public','=', 'true') ->get();
        // dd($query);
        return view('pages.admin', ['users' => User::all()->except(Auth::id()),'events' => $events]);

        

    }
    
}
