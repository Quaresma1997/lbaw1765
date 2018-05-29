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
use App\Post;
use App\Poll;
use App\Option;
use App\Category;
use App\Image;

use Gate;


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

    public function show($id)
    {

      $event = Event::find($id);
      
      if($event == null)
        return redirect('404');
        
      if(!$event->is_public)
        if(Auth::check()){
          if(Gate::denies('see-event', $event))
            return redirect('index');
        }else {
            return redirect('index');
        }
     
      // $city = DB::select('SELECT city_id FROM users WHERE id = ?', [$id]);

      //$this->authorize('show', $user);

      return view('pages.events', $this->getFieldsTosend($event));
    }

      function cmp_users($a, $b)
{
    return strcmp($a->username, $b->username);
}
    
private function getFieldsTosend($event){
      

      if(!$event->is_public)
        if(Auth::check()){
          if(Gate::denies('see-event', $event))
            return redirect('index');
        }else {
            return redirect('index');
        }

      $loca = Localization::find($event->localization_id);
      $city = City::find($loca->city_id);
      $country = Country ::find($city->country_id);
      $event->city = $city->name;
      $event->country = $country->name;
      $event->place = $loca->name;
      $event->address= $loca->address; 
      $categories = Category::all();   
      
      $participants_invited_ids = array();
      $friends_to_invite = array();

      foreach($event->event_invites as $invite){
        array_push($participants_invited_ids, $invite->receiver_id);
      }

      foreach($event->participants as $participant){
          array_push($participants_invited_ids, $participant->user_id);
      }

      if(Auth::check()){
        $user = Auth::user();

        foreach($user->getFriends() as $friend){
          if(!in_array($friend->id,$participants_invited_ids))
            array_push($friends_to_invite, $friend);
          array_push($participants_invited_ids, $friend->id);
        }

        usort($friends_to_invite, array($this, "cmp_users"));
      }

      

      $admin_id = User::where('username', 'admin')->first()->id;
      
      array_push($participants_invited_ids, $event->owner->id);
      array_push($participants_invited_ids, $admin_id);


      return ['event' => $event, 'categories' => $categories, 'friends' => $friends_to_invite, 'users' => User::all()->except($participants_invited_ids)->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE)];
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
        'date' => 'required|date|after:today',
        'country' => 'required|string|max:30',
        'city' => 'required|string|max:30',
        'place' => 'required|string|max:30',
       'address' => 'required|string|max:30',
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
     $event->time = $data->input('time');
     $event->description = $data->input('description');
     $event->owner_id = Auth::user()->id;
    $event->is_public = $data->input('is_public');
     $event->category_id = $data->input('category');
     
      // LOCALIZATION_ID

     $city = $data->input('city');
     $country = $data->input('country');

     

     $country_id = DB::table('countries')->select('id')->where('name', $country)->first();

     if($country_id == null){
      $new_country = new Country();

      
      $new_country->name = $country;
      $new_country->save();

      $country_id = DB::table('countries')->select('id')->where('name', $country)->first();
      
    }
    
    $city_id = DB::table('cities')->select('id')->where('name', $city)->first();

    if($city_id == null){
      $new_city = new City();


      $new_city->name = $city;
      $new_city->country_id = $country_id->id;
      $new_city->save();
      

      $city_id = DB::table('cities')->select('id')->where('name', $city)->first();
      
    }else{
      $existing_city = City::find($city_id->id);

      if($existing_city->country_id != $country_id->id){
        $new_city = new City();


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
    try{
      $event->delete();
      return response()->json(['message' => 'success']);
    }catch (QueryException $e){
      return response()->json(['message' => 'Error deleting event']);
    }
    
  }

  public function update(Request $request, $id){

    
   
    $event = Event::find($id);
    $this->authorize('update', $event);

    $validator = $this->valid($request);
    
    if(!$validator->passes())
      return view('pages.events', $this->getFieldsTosend($event), ['errors' => $validator->errors()]);

    $event->name = $request->input('name');
    $event->date = $request->input('date');
    $event->time = $request->input('time');
    $event->description = $request->input('description');
    
     
    
    $type = $request->input('type');
    if($type == "Public")
      $is_public = true;
    else
      $is_public = false;

    $event->is_public = $is_public;

     $category = $request->input('category');

     $event->category_id = DB::table('categories')->select('id')->where('name', $category)->first()->id;

    

    $city = $request->input('city');
    $country = $request->input('country');

    

    $country_id = DB::table('countries')->select('id')->where('name', $country)->first();
    

    if($country_id == null){
      $new_country = new Country();      
      
      $new_country->name = $country;
      $new_country->save();

      $country_id = DB::table('countries')->select('id')->where('name', $country)->first();
      
    }
    
    
    $city_id = DB::table('cities')->select('id')->where('name', $city)->first();

    if($city_id == null){
      $new_city = new City();


      $new_city->name = $city;
      $new_city->country_id = $country_id->id;
      $new_city->save();
      

      $city_id = DB::table('cities')->select('id')->where('name', $city)->first();
      
    }else{
      $existing_city = City::find($city_id->id);

      if($existing_city->country_id != $country_id->id){
        $new_city = new City();


        $new_city->name = $city;
        $new_city->country_id = $country_id->id;
        $new_city->save();
        

        $city_id = DB::table('cities')->select('id')->where('name', $city)->where('country_id', $country_id->id)->first();
      }
    }

    

    $localization = Localization::find($event->localization_id);

    

    $localization->name = $request->input('place');
    $localization->city_id = $city_id->id;
    $localization->address = $request->input('address');

    if($request->hasFile("images")){
          $images = $request->file("images");
          foreach($images as $image){
            if($image->isValid()){
              $filename = $image->getClientOriginalName();
              $image->move(public_path('/imgs'), $image);
              $old_img = Image::where('event_id', $event->id)->where('path', $filename);
              if($old_img == null){
                $newImg = new Image();
                $newImg->path = $filename;
                $newImg->event_id = $event->id;
                $newImg->save();
              }
            }
            
          }
          
        
      }

    try{
      $localization->save();
    }catch (QueryException $e){
      return view('pages.events', $this->getFieldsTosend($event), ['errors' => $validator->errors()]);
    }

    try{
      $event->save();
    }catch (QueryException $e){
      return view('pages.events', $this->getFieldsTosend($event), ['errors' => $validator->errors()]);
    }

    return redirect('events/' . $event->id);
    
    // return response()->json(['message' => 'success', 'event' => $event, 'localization' => $localization, 'city' => $event->localization->city->name, 'country' => $event->localization->city->country->name, 'category' => $event->category->name]);

  }

 


}
