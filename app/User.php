<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Shortcut;

//use Laravel\Scout\Searchable;
//use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;
    //use Searchable;

    // Don't add create and update timestamps in database.
    public $timestamps  = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'first_name', 'last_name', 'city_id', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    // public function getData($id){
    //     // $user_id = DB::select('SELECT id FROM users WHERE username = ?', [$username]);
    //     $user = User::find($id);
    //     // $user = DB::select('SELECT * FROM users WHERE username = ?', [$username]);

    //     //$this->authorize('getData', $user);

    //     return $user;
    // }

      public function city(){

        return $this->belongsTo('App\City');

      }
  
  public function events(){

    return $this->hasMany('App\Event', 'owner_id');

  }
  public function poll_votes(){

    return $this->hasMany('App\Poll_votes');

  }

  public function getOption($poll_id){

    $vote = Poll_votes::where('poll_id',$poll_id)->where('user_id',$this->id)->get();
    if($vote->isEmpty()){
      return null;
    }else{
      $option = $vote[0]->option_id;
      return $option;
      //returns option  id;
    }
     
  }

   public function shortcuts(){

    return $this->hasMany('App\Shortcut', 'user_id');

  }

  public function participants(){

    return $this->hasMany('App\Participant');

  }

  public function event_invites(){

    return $this->hasMany('App\EventInvite', 'receiver_id');

  }

  public function invite_to_event($event_id){
    if(sizeof($this->event_invites) != 0)
      return $this->event_invites->where('receiver_id', $this->id)->where('event_id', $event_id)->first();
    else
      return null;

  }

  public function friend_requests_received(){

    return $this->hasMany('App\FriendRequest', 'receiver_id');

  }

  public function friend_requests_sent(){
    return $this->hasMany('App\FriendRequest', 'sender_id');
  }

  public function event_delete_warnings(){
    return $this->hasMany('App\EventDeleteWarning', 'receiver_id');
  }

  public function event_update_warnings(){
    return $this->hasMany('App\EventUpdateWarning', 'receiver_id');
  }

  public function inEvent($event_id){
        return Participant::where('user_id', $this->id)->where('event_id', $event_id)->first();
    }

   public function getFriends(){
    $friendships = Friendship::where('user_id_1', $this->id)->orWhere('user_id_2', $this->id)->get();
    $friends = array();

     foreach($friendships as $friendship){
       if($friendship->user_id_1 == $this->id){
         array_push($friends, $friendship->user2);
       }else{
         array_push($friends, $friendship->user1);
       }
               
      }

      return $friends;
    // return $this->hasMany('App\Friendship', 'user_id_1')->hasMany('App\Friendship', 'user_id_2');
  }

  public function getFriendsEvents(){
    $friends = $this->getFriends();
    $friend_events = [];
    if($friends != null){
      $friend_events = array();
      foreach($friends as $friend){
          foreach($this->publicFriendEvents($friend) as $event){
            array_push($friend_events, $event);
          }
                
            }
          }

    usort($friend_events, array($this, "cmp_participation"));
          

          return $friend_events;
  }

  public function publicFriendEvents($friend){
    $participants = $friend->participants;
        $participating = [];
        if($participants != null){
            $participating = array();
            foreach($participants as $participant){
              if($participant->event->is_public){
                $new_event = $participant->event;
                $new_event->participant = $participant;
                array_push($participating, $new_event);
              }
            }
        }
        return $participating;
  }

  function cmp_participation($a, $b)
{
    return strcmp($a->participant->created_at, $b->participant->created_at);
}

public function numEvents(){
  return sizeof($this->allEvents());
}


  
    public function friendWith($user_id){
        return (Friendship::where('user_id_1', $this->id)->where('user_id_2', $user_id)->first()
                || Friendship::where('user_id_2', $this->id)->where('user_id_1', $user_id)->first());
    }
    
    public function sentFriendRequestTo($user_id){
      $users_ids = array();
      foreach($this->friend_requests_sent as $request){
        array_push($users_ids, $request->receiver_id);
      }

      return in_array($user_id, $users_ids);
    }

     public function receivedFriendRequestFrom($user_id){
      $users_ids = array();
      foreach($this->friend_requests_received as $request){
        array_push($users_ids, $request->sender_id);
      }

      return in_array($user_id, $users_ids);
    }

    public function notifications(){
      $notifications3 = $this->friend_requests_received->toBase()->merge($this->event_invites);
      $notifications2 = $this->event_delete_warnings->toBase()->merge($notifications3);
      $notifications = $this->event_update_warnings->toBase()->merge($notifications2);

      $not_array = array();

      foreach($notifications as $notification){
        if($notification instanceof EventInvite)
          $notification->type = 1;
        elseif($notification instanceof FriendRequest)
          $notification->type = 2;
        elseif($notification instanceof EventDeleteWarning)
          $notification->type = 3;
        elseif($notification instanceof EventUpdateWarning)
          $notification->type = 4;
        array_push($not_array, $notification);
      }

      usort($not_array, array($this, "cmp_notifications"));


      return $not_array;
    }

      function cmp_notifications($a, $b)
{
    return strcmp($a->created_at, $b->created_at);
}

public function eventsParticipating(){
  $participants = $this->participants;
        $participating = [];
        if($participants != null){
            $participating = array();
            foreach($participants as $participant){
                array_push($participating, $participant->event);
            }
        }

        return $participating;
}

public function cmp_events_asc($a, $b)
{
  return strcmp($a->date, $b->date);
}

public function cmp_events_desc($a, $b)
{
  return strcmp($b->date, $a->date);
}

public function allEvents(){
  $all_events = $this->eventsParticipating();

  foreach($this->events as $e){
    array_push($all_events, $e);
  }

  $dones = array();
  $not_dones = array();

  foreach($all_events as $e){
    if($e->done == null){
      array_push($not_dones, $e);
    }else{
      array_push($dones, $e);
    }
  }

  usort($not_dones, array($this, "cmp_events_asc"));
  usort($dones, array($this, "cmp_events_desc"));

  $all_events = array_merge($not_dones, $dones);

  return $all_events;
}

public function eventsNotShortcuts(){
  $all_events = $this->allEvents();
  $notShortcuts = array();
  foreach($all_events as $ev){
    if(Shortcut::where('event_id', $ev->id)->where('user_id', $this->id)->first() == null)
      array_push($notShortcuts, $ev);
  }
  return $notShortcuts;
}

public function publicEvents(){
  $public_events = array();

  foreach($this->allEvents() as $e){
    if($e->is_public)
      array_push($public_events, $e);
  }

  $dones = array();
  $not_dones = array();

  foreach($public_events as $e){
    if($e->done == null){
      array_push($not_dones, $e);
    }else{
      array_push($dones, $e);
    }
  }

  usort($not_dones, array($this, "cmp_events_asc"));
  usort($dones, array($this, "cmp_events_desc"));

  $public_events = array_merge($not_dones, $dones);

  return $public_events;
}

}




