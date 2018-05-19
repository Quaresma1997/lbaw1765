<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

use App\EventInvite;
use App\FriendRequest;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'first_name', 'last_name', 'city_id', 'password'
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
          foreach($this->publicEvents($friend) as $event){
            array_push($friend_events, $event);
          }
                
            }
          }

    usort($friend_events, array($this, "cmp_participation"));
          

          return $friend_events;
  }

  public function publicEvents($friend){
    $participants = $friend->participants;
        $participating = [];
        if($participants != null){
            $participating = array();
            foreach($participants as $participant){
              if($participant->event->is_public)
              $new_event = $participant->event;
              $new_event->participant = $participant;
                array_push($participating, $new_event);
            }
        }
        return $participating;
  }

  function cmp_participation($a, $b)
{
    return strcmp($a->participant->created_at, $b->participant->created_at);
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
      $notifications = $this->friend_requests_received->toBase()->merge($this->event_invites);

      $not_array = array();

      foreach($notifications as $notification){
        if($notification instanceof EventInvite)
          $notification->type = 1;
        elseif($notification instanceof FriendRequest)
          $notification->type = 2;
        array_push($not_array, $notification);
      }

      usort($not_array, array($this, "cmp_notifications"));


      return $not_array;
    }

      function cmp_notifications($a, $b)
{
    return strcmp($a->created_at, $b->created_at);
}

}




