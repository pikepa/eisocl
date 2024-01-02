<?php

use App\Models\Thread;

test('a user can subscribe to threads', function () {
    loginAs();
    //given we have a thread
    $thread = Thread::factory()->create();
    // and the user subscribes to the thread

    // then each time a new reply is left..
    $thread->addReply([
        'user_id' => auth()->id(),
        'body' => 'some reply here'
    ]);
    // A notificatioon should be prepared to the user
    // $this->assertCount(1, auth()->user()->notifications)
});
