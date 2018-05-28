<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Option extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  public function poll(){
    return $this->belongsTo('App\Poll');
  }

  public function poll_votes(){

    return $this->hasMany('App\Poll_votes');

  }



}
