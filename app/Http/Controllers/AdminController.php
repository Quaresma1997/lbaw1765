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
    
}
