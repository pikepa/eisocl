<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;

class ActivitiesController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  User  $user
     * @return \Response
     */
    public function show(User $user)
    {
     //   return $user->activity()->with('subject')->latest()->get();
        return view('activities.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user),
        ]);
    }
}
