<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

use App\City;
use App\Country;

class RegisterController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/homepage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'city' => 'required|string|max:30',
            'country' => 'required|string|max:30',
            'password' => 'required|string|min:4|confirmed',
            'image_path' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $country_id = DB::table('countries')->select('id')->where('name', $data['country'])->first();

      if($country_id == null){
        $country = new Country();

        // $this->authorize('create', $country);
  
        $country->name = $data['country'];
        $country->save();

        $country_id = DB::table('countries')->select('id')->where('name', $data['country'])->first();
        
      }


      $city_id = DB::table('cities')->select('id')->where('name', $data['city'])->first();

      if($city_id == null){
        $city = new City();

        // $this->authorize('create', $city);
  
        $city->name = $data['city'];
        $city->country_id = $country_id->id;
        $city->save();

        $city_id = DB::table('cities')->select('id')->where('name', $data['city'])->first();
        
      }

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'city_id' => $city_id->id,
            'password' => bcrypt($data['password']),
            'image_path' => $data['image_path'],
        ]);
    }
}
