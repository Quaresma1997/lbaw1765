<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
      // Only a card owner can see it
      return Auth::check();
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function update(User $user)
    {
      // Any user can create a new card
      return Auth::user()->id == $user->id;
    }

    public function delete(User $user, Card $card)
    {
      // Only a card owner can delete it
      return $user->id == $card->user_id;
    }
}
