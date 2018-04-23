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
            'name' => 'required|string|max:30',
            'city' => 'required|string|max:30',
            'country' => 'required|string|max:30',
            'place' => 'required|string|max:30',
            // 'address' => 'required|string|max:30',
            'description' => 'string|max:255',
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

      $city = $request->input('city');
      $country = $request->input('country');

     

      $country_id = DB::table('countries')->select('id')->where('name', $country)->first();

        if($country_id == null){
          $new_country = new Country();

          $this->authorize('create', $user);
    
          $new_country->name = $country;
          $new_country->save();

          $country_id = DB::table('countries')->select('id')->where('name', $country)->first();
          
        }
      
        $city_id = DB::table('cities')->select('id')->where('name', $city)->first();

        if($city_id == null){
          $new_city = new City();

          $this->authorize('create', $user);

          $new_city->name = $city;
          $new_city->country_id = $country_id->id;
          $new_city->save();
          

          $city_id = DB::table('cities')->select('id')->where('name', $city)->first();
          
        }else{
          $existing_city = City::find($city_id->id);

          if($existing_city->country_id != $country_id->id){
            $new_city = new City();

            $this->authorize('create', $user);

            $new_city->name = $city;
            $new_city->country_id = $country_id->id;
            $new_city->save();
            

            $city_id = DB::table('cities')->select('id')->where('name', $city)->where('country_id', $country_id->id)->first();
          }
        }

      $localization = new Localization();

      $this->authorize('create', $localization);

      $localization->name = $data->input('place');
      $localization->address = $data->input('address');
      $localization->city_id = $city_id->id;

      $localization->save();
            
      $event->localization_id = $localization->id;

      $event->save();



      return response()->json(['message' => 'success', 'id' => $event->id]);
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

    public function update(Request $request, $id){
       
      $event = Event::find($id);
      $this->authorize('update', $event);

      $validator = $this->valid($request);
     
      if(!$validator->passes())
        return response()->json(['message' => $validator->errors()->all()]);

      $event->name = $request->input('name');
      $event->date = $request->input('datetime');
      $event->description = $request->input('description');

      $city = $request->input('city');
      $country = $request->input('country');

     

      $country_id = DB::table('countries')->select('id')->where('name', $country)->first();

        if($country_id == null){
          $new_country = new Country();

          $this->authorize('create', $user);
    
          $new_country->name = $country;
          $new_country->save();

          $country_id = DB::table('countries')->select('id')->where('name', $country)->first();
          
        }
      
        $city_id = DB::table('cities')->select('id')->where('name', $city)->first();

        if($city_id == null){
          $new_city = new City();

          $this->authorize('create', $user);

          $new_city->name = $city;
          $new_city->country_id = $country_id->id;
          $new_city->save();
          

          $city_id = DB::table('cities')->select('id')->where('name', $city)->first();
          
        }else{
          $existing_city = City::find($city_id->id);

          if($existing_city->country_id != $country_id->id){
            $new_city = new City();

            $this->authorize('create', $user);

            $new_city->name = $city;
            $new_city->country_id = $country_id->id;
            $new_city->save();
            

            $city_id = DB::table('cities')->select('id')->where('name', $city)->where('country_id', $country_id->id)->first();
          }
        }

        $localization = Localization::find($event->localization_id);

        $localization->name = $request->input('place');
        $localization->city_id = $city_id->id;
        // $localization->address = $request->input('address');

        $localization->save();
            
        $event->save();

        return response()->json(['message' => 'success', 'event' => $event, 'localization' => $localization, 'city' => $event->getCity($localization->id), 'country' => $event->getCountry($city_id->id)]);

    }


}
