<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ThreadReceivedNewReply;
use App\Notifications\YouWereMentioned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMentionedUsers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ThreadReceivedNewReply $event): void
    {
        // Inspect Reply for user mentions and then 
        collect($event->reply->mentionedUsers()) //make a collection of names from the array
            ->map(function ($name){
                return User::where('name', $name)->first();  //finds the users
            })
            ->filter()  //eliminates null values for $user
            ->each(function ($user) use ($event) {
                $user->notify(new YouWereMentioned($event->reply));  //notifies each user
            });

    }
}
