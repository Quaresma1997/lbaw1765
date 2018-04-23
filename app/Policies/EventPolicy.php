<?php

namespace App\Policies;

use App\User;
use App\Event;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Event $event)
    {
      // Only a card owner can see it
      return Auth::check();
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function add(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function delete(User $user, Event $event)
    {
      // Only an event owner can delete it
      return $user->id == $event->owner_id;
    }

    public function update(User $user, Event $event)
    {
      // Only an event owner can delete it
      return $user->id == $event->owner_id;
    }
}
