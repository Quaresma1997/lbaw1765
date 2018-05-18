<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendActivity extends Model
{
    public $timestamps  = false;

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
