<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Poll extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  public function event(){
    return $this->belongsTo('App\Event');
  }


public function options(){

    return $this->hasMany('App\Option');

  }

  public function poll_votes(){

    return $this->hasMany('App\Poll_votes');

  }

}
