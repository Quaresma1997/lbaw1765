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

      public function city(){

        return $this->belongsTo('App\City');

      }
  
  public function events(){

    return $this->hasMany('App\Event', 'owner_id');

  }

  public static function getAll() {
		return DB::table('users')->get();
	}
 


    // /**
    //  * The cards this user owns.
    //  */
    //  public function cards() {
    //   return $this->hasMany('App\Card');
    // }
}
