<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'first_name', 'last_name', 'city_id', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function getData($id){
    //     // $user_id = DB::select('SELECT id FROM users WHERE username = ?', [$username]);
    //     $user = User::find($id);
    //     // $user = DB::select('SELECT * FROM users WHERE username = ?', [$username]);

    //     //$this->authorize('getData', $user);

    //     return $user;
    // }

    public function getCity($id){
        $city_id = DB::table('users')->select('city_id')->where('id', $id)->first()->city_id;
        return DB::table('cities')->select('name')->where('id', $city_id)->first()->name;
    }

    public function getCountry($city_id){
        $country_id = DB::table('cities')->select('country_id')->where('id', $city_id)->first()->country_id;
        return DB::table('countries')->select('name')->where('id', $country_id)->first()->name;
      }

      /**
   * Items inside this card
   */
  public function events() {
      $cities = array();
      $countries = array();
    $events = DB::table('events')->where('owner_id', $this->id)->orderBy('id')->get();
    foreach($events as $event){
        $loca = Localization::find($event->localization_id);
        $city = City::find($loca->city_id);
        $country = Country ::find($city->country_id);
        $event->city = $city->name;
        $event->country = $country->name;
        array_push($cities, $city->name);
        array_push($countries, $country->name);
    }
    
    return $events;
  }
  





    // /**
    //  * The cards this user owns.
    //  */
    //  public function cards() {
    //   return $this->hasMany('App\Card');
    // }
}
