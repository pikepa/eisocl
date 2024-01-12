<?php

namespace App\Listeners;

use App\Events\ThreadReceivedNewReply;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubscribers
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
        $event->reply->thread->subscriptions
        ->where('user_id', '!=', $event->reply->user_id)
        ->each
        ->notify($event->reply);    }
}
