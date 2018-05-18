<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

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
                array_push($friend_events, $friend->publicEvents());
            }
          }

          return $friend_events;
  }

  public function publicEvents(){
    $participants = $this->participants;
        $participating = [];
        if($participants != null){
            $participating = array();
            foreach($participants as $participant){
              if($participant->event->is_public)
                array_push($participating, $participant->event);
            }
        }
        return $participating;
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



    // /**
    //  * The cards this user owns.
    //  */
    //  public function cards() {
    //   return $this->hasMany('App\Card');
    // }
}
