<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\City;
use App\Country;
use App\Category;
use Image;

class ProfileController extends Controller
{
    // /**
    //  * Shows the index
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function show()
    // {
    //   $user_data = User::getData(Auth::user()>username);
    //   return view('pages.profile', $user_data);
    // }

    /**
     * Shows the profile for a given username.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $user = User::find($id);
      if($user == null)
        return redirect('404');
      $city_id = DB::table('users')->select('city_id')->where('id', $id)->first()->city_id;
      $city = DB::table('cities')->select('*')->where('id', $city_id)->first();
      if($city == null){
        $city_name = "City";
        $country = "Country";
      }else{
        $country = DB::table('countries')->select('name')->where('id', $city->country_id)->first()->name;      
        $city_name = $city->name;
      }
      $categories = Category::all();

      

      // $this->authorize('show', $user);
      
      return view('pages.profile', ['user' => $user, 'city' => $city_name, 'country' => $country, 'categories' => $categories]);
    }

    private function valid(Request $request, $check_email){
      if($check_email)
        return Validator::make($request->all(), [
          'email' => 'required|string|email|max:255|unique:users',
          'first_name' => 'required|string|max:30',
          'last_name' => 'required|string|max:30',
          'city' => 'required|string|max:30',
          'country' => 'required|string|max:30',
        ]);
      else
        return Validator::make($request->all(), [
          'first_name' => 'required|string|max:30',
          'last_name' => 'required|string|max:30',
          'city' => 'required|string|max:30',
          'country' => 'required|string|max:30',
        ]);
    }

    /**
     * Updates the profile of an user.
     *
     * @param  int  $id
     * @param  Request request containing the new state
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $user = User::find($id);
      if($user == null)
        return redirect('404');
      $this->authorize('update', $user);



      if($user->email == $request->input('email'))
        $check_email = false;
      else {
        $check_email = true;
      }
      $validator = $this->valid($request, $check_email);

      

      // $this->authorize('show', $user);
      
      

      if(!$validator->passes()){
        $city_id = DB::table('users')->select('city_id')->where('id', $id)->first()->city_id;
      $city = DB::table('cities')->select('*')->where('id', $city_id)->first();
      $country = DB::table('countries')->select('name')->where('id', $city->country_id)->first()->name;
      $categories = Category::all();

        return view('pages.profile', ['user' => $user, 'city' => $city->name, 'country' => $country, 'categories' => $categories, 'errors' => $validator->errors()]);

      }

      $user->first_name = $request->input('first_name');
      $user->last_name = $request->input('last_name');
      $user->email = $request->input('email');
      if($request->hasFile("fileupload")){
        if($request->file("fileupload")->isValid()){
          $avatar = $request->file("fileupload");
          $filename = $avatar->getClientOriginalName();
          $avatar->move(public_path('/imgs'), $filename);
          $user->image_path = $filename;
        }
      }
      

      $city = $request->input('city');
      $country = $request->input('country');

      $country = ucfirst(strtolower($country)); 
        $country = str_replace(' ', '', $country);

        $city = ucfirst(strtolower($city)); 
        $city = str_replace(' ', '', $city);

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


      $user->city_id = $city_id->id;

      $user->save();
      
      
      return redirect('profile/' . $user->id);
      // return response()->json(['message' => 'success', 'user' => $user, 'city' => $user->city->name, 'country' => $user->city->country->name]);
    }

    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      if($user == null)
        return redirect('404');
      $this->authorize('delete', $user);

      
      if($user->delete()){
        Auth::logout();
        return response()->json(['message' => 'success']);
      }else
        return response()->json(['message' => 'Error deleting profile!']);
    }
  }
