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
        return $this->belongsTo('App\User', 'owner_id');
      }

      public function localization() {
        return $this->belongsTo('App\Localization');
      }

      public function posts(){

        return $this->hasMany('App\Post');

      }
      public function polls(){

        return $this->hasMany('App\Poll');
    
      }

      public function done(){
        return $this->hasOne('App\Done');
      }

       public function not_done(){
        return $this->hasOne('App\NotDone');
      }

      public function participants() {
        return $this->hasMany('App\Participant');
      }

      public function event_invites(){
       return $this->hasMany('App\EventInvite');
      }

      public function category() {
        return $this->belongsTo('App\Category');
    }

    public function images(){
      return $this->hasMany('App\Image');
    }

     public function image(){
      return $this->hasOne('App\Image');
    }

    public function rating($user_id){
      return Rating::where('event_id', $this->id)->where('user_id', $user_id)->first();
    }

    


 
      
}
