<?php

use App\Models\Thread;
use App\Models\User;

test('a notification is prepared when a subscribed thread receives a new reply that is not by the current user', function () {
    loginAs();
    $thread = Thread::factory()->create();
    $thread->subscribe();  //
    $this->assertCount(0, auth()->user()->notifications);
    //User 1 replying to thread - no need for notification.
    $thread->addReply([
        'user_id' => auth()->id(),
        'body' => 'Some reply here',
    ]);
    // No notification for user1 added
    $this->assertCount(0, auth()->user()->fresh()->notifications);
    //a third user adds a reply to the same thread - so User 1 should get a notification
    $thread->addReply([
        'user_id' => User::factory()->create()->id,
        'body' => 'Some reply here',
    ]);
    $this->assertCount(1, auth()->user()->fresh()->notifications);
});
