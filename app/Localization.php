<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Localization extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  public function city(){

    return $this->belongsTo('App\City');

  }

}
