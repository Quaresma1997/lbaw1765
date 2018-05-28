<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Poll_votes extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function option(){
    return $this->belongsTo('App\Option');
  }

 public function poll(){
    return $this->belongsTo('App\Poll');
  }


  public function countVotes($option_id){

    $votes = count(Poll_votes::where('option_id',$option_id )->get());
  
    return $votes;

  }

}
