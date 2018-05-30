<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
    
use App\City;
use App\Country;
use App\Event;
use App\Localization;

class CountryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function list(Request $data)
    {
        try{
            $countries =  DB::table('countries')->get();
            // $countries = Country::all();
            return response()->json(['message'=>"success", 'countries' => $countries]);
        }catch (QueryException $e){
            return response()->json(['message'=>"Error getting countries!"]);
        }
        
    }

}
