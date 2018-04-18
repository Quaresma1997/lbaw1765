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

class EventController extends Controller
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //METER PARA O EVENTO
    // protected $redirectTo = '/homepage';

    public function show($id)
    {
      $event = Event::find($id);
      
      $this->authorize('show', $event);
      

      $loca = Localization::find($event->localization_id);
        $city = City::find($loca->city_id);
        $country = Country ::find($city->country_id);
        $event->city = $city->name;
        $event->country = $country->name;
        $event->place = $loca->name;

      
      // $city = DB::select('SELECT city_id FROM users WHERE id = ?', [$id]);

      //$this->authorize('show', $user);

      return view('pages.events', ['event' => $event]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function valid(Request $data)
    {
        return Validator::make($data->all(), [
            'name' => 'required|string|max:30|unique:events',
            'date' => 'required|date|after:today',
            'city' => 'required|string|max:30',
            'country' => 'required|string|max:30',
            'place' => 'required|string|max:30',
            'address' => 'required|string|max:30',
            'description' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function add(Request $data)
    {
       $validated = $this->valid($data);
       if(!$validated->passes())
         return response()->json(['message' => $validated->errors()->all()]);
        
      $event = new Event();

      $this->authorize('add', $event);

      $event->name = $data->input('name');
      $event->date = $data->input('date');
      $event->description = $data->input('description');
      $event->owner_id = Auth::user()->id;
      $event->type = $data->input('type');
      $event->category = $data->input('category');
 
      // LOCALIZATION_ID

      $country_id = DB::table('countries')->select('id')->where('name', $data['country'])->first();

      if($country_id == null){
        $country = new Country();

        $this->authorize('create', $country);
  
        $country->name = $data['country'];
        $country->save();

        $country_id = DB::table('countries')->select('id')->where('name', $data['country'])->first();
        
      }


      $city_id = DB::table('cities')->select('id')->where('name', $data['city'])->first();

      if($city_id == null){
        $city = new City();

        $this->authorize('create', $city);
  
        $city->name = $data['city'];
        $city->country_id = $country_id->id;
        $city->save();

        $city_id = DB::table('cities')->select('id')->where('name', $data['city'])->first();
        
      }

      $localization = new Localization();

      $this->authorize('create', $localization);

      $localization->name = $data->input('place');
      $localization->address = $data->input('address');
      $localization->city_id = $city_id->id;

      $localization->save();
            
      $event->localization_id = $localization->id;

      $event->save();



      return response()->json(['message' => 'success']);
    }

    public function delete(Request $request, $id)
    {
      $event = Event::find($id);

      $this->authorize('delete', $event);
        
      if($event->delete())
        return redirect('/');

      else
      return response()->json(['message' => 'error', 'error' => 'Error deleting event!']);
    }


}
