<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function event(){
    return $this->belongsTo('App\Event');
  }

  public function getUser($id){
    $user_id = DB::table('posts')->select('$user_id')->where('id', $id)->first()->user_id;
    return DB::table('users')->select('username','image_path')->where('id', $user_id)->first()->username;


  }

  
  

}
