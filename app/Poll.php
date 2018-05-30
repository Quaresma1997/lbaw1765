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

  public function countVotes($option_id){

    $votes = count(Poll_votes::where('option_id',$option_id )->get());
  
    return $votes;

  }

}
