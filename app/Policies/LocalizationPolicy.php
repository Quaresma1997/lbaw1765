<?php

namespace App\Policies;

use App\User;
use App\Localization;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class LocalizationPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Localization $loca)
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

    public function delete(User $user, Localization $loca)
    {
      // Only an event owner can delete it
      return $user->id == $event->owner_id;
    }
}
