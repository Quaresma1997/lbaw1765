<?php

namespace App\Policies;

use App\Country;

use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    // public function create(User $user)
    // {
    //   // User can only create items in cards they own
    //   return Auth::check();
    // }

    // public function update(User $user, Item $item)
    // {
    //   // User can only update items in cards they own
    //   return $user->id == $item->card->user_id;
    // }

    // public function delete(User $user, Item $item)
    // {
    //   // User can only delete items in cards they own
    //   return $user->id == $item->card->user_id;
    // }
}
