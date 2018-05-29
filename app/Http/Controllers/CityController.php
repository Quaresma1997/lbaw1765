<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\City;
use App\Country;
use App\Event;
use App\Localization;

class CityController extends Controller
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

    public function list(Request $data, $country)
    {
        $country = ucfirst(strtolower($country)); 
        $country = str_replace(' ', '', $country);

        if($country == "Other")
            $country_id = DB::table('countries')->select('id')->first()->id;
        else
            $country_id = DB::table('countries')->select('id')->where('name', $country)->first()->id;
        
        $cities = City::where('country_id', $country_id)->get();
        return response()->json(['cities' => $cities]);
    }

}
