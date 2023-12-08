<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

test('an authenticated user may participate in Forum Threads', function () 
{
    $this->be(User::factory()->create());
    $thread = Thread::factory()->create();
    $reply= Reply::factory()->make();
    $this->post('threads/'.$thread->id . '/replies', $reply->toArray());
    $this->get($thread->path())
        ->assertSee($reply->body);
});
