<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;


    // public function getTypes(){
    //     $types = DB::select(DB::raw('SHOW COLUMNS FROM events WHERE Field = 'types_of_events '))
    //     return DB::table('cities')->select('name')->where('id', $city_id)->first()->name;
    // }

    // public function getLocalization($city_id){
    //     $country_id = DB::table('cities')->select('country_id')->where('id', $city_id)->first()->country_id;
    //     return DB::table('countries')->select('name')->where('id', $country_id)->first()->name;
    //   }

    public function owner() {
        return $this->belongsTo('App\User');
      }

    public function getCity($id){
        $city_id = DB::table('users')->select('city_id')->where('id', $id)->first()->city_id;
        return DB::table('cities')->select('name')->where('id', $city_id)->first()->name;
    }

    public function getCountry($city_id){
        $country_id = DB::table('cities')->select('country_id')->where('id', $city_id)->first()->country_id;
        return DB::table('countries')->select('name')->where('id', $country_id)->first()->name;
      }

}
