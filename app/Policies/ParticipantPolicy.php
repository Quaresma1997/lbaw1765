<?php

namespace App\Policies;

use App\User;
use App\Participant;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ParticipantPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new card
      return true;
    }

    public function delete(User $user, Participant $part)
    {
      // Only an event owner can delete it
      return $user->id == $part->user_id;
    }
}
