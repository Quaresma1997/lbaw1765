<?php

namespace App\Policies;

use App\User;
use App\FriendActivity;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class FriendActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function delete(User $user, FriendActivity $friend_activity)
    {
      // Only an event owner can delete it
      return ($user->id == $friend_activity->sender_id || $user->id == $friend_activity->receiver_id);
    }
    
    public function update(User $user, FriendActivity $friend_activity){
      return ($user->id == $friend_activity->sender_id || $user->id == $friend_activity->receiver_id);
    }
  }
