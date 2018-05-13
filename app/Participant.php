<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public $timestamps  = false;
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getEvents() {
        $event_ids = Participant::select('event_id')->where('user_id', $this->user_id)->get();
        $events = array();
        foreach($event_ids as $event){
            array_push($events, Event::where('id', $event->event_id)->first());
        }
        return $events;
    }

    

    public function event(){
        return $this->belongsTo('App\Event');
    }
    //
}
