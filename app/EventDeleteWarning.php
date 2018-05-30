<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDeleteWarning extends Model
{
    public $timestamps  = true;

    public function receiver() {
        return $this->belongsTo('App\User', 'receiver_id');
      }
}
