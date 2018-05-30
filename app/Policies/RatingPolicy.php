<?php

namespace App\Policies;

use App\User;
use App\Rating;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
{
    use HandlesAuthorization;
public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function update(User $user, Rating $rating){
      return ($user->id == $rating->user_id);
    }
}
