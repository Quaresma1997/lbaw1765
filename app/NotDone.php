<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class NotDone extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  public $primaryKey = 'event_id';

  public function event(){
    return $this->belongsTo('App\Event');
  }


}
