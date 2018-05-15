<?php

namespace App\Policies;

use App\User;
use App\Friendship;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
class FriendshipPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function delete(User $user, Friendship $friend)
    {
      // Only an event owner can delete it
      return ($user->id == $friend->user_id_1 || $user->id == $friend->user_id_2);
    }
}
