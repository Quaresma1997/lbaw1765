<?php

namespace App\Policies;

use App\User;
use App\FriendRequest;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class FriendRequestPolicy
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

    public function delete(User $user, FriendRequest $friend_request)
    {
      // Only an event owner can delete it
      return ($user->id == $friend_request->sender_id || $user->id == $friend_request->receiver_id);
    }
    
    public function update(User $user, FriendRequest $friend_request){
      return ($user->id == $friend_request->sender_id || $user->id == $friend_request->receiver_id);
    }
  }
