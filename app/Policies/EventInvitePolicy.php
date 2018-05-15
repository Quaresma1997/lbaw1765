<?php

namespace App\Policies;

use App\User;
use App\EventInvite;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventInvitePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function delete(User $user, EventInvite $invite, User $owner)
    {
      // Only an event owner can delete it
      return ($user->id == $invite->sender_id || $user->id == $invite->receiver_id || $user->id == $owner->id);
    }

    public function update(User $user, EventInvite $invite){
      return ($user->id == $invite->sender_id || $user->id == $invite->receiver_id);
    }
}
