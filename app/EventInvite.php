<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventInvite extends Model
{
    public $timestamps  = true;

    public function sender() {
        return $this->belongsTo('App\User', 'sender_id');
      }

      public function receiver() {
        return $this->belongsTo('App\User', 'receiver_id');
      }

       public function event() {
        return $this->belongsTo('App\Event', 'event_id');
      }
}
