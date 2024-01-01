<?php

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;

test('it has an owner', function () {
    $reply = Reply::factory()->create();
    $this->assertInstanceOf(User::class, $reply->owner);
});

test('it belongs to a thread', function () {
    $reply = Reply::factory()->create();
    $this->assertInstanceOf(Thread::class, $reply->thread);
});

test('it has a path', function () {
    $reply = Reply::factory()->create();
    $this->assertEquals($reply->thread->path().'#reply-'.$reply->id, $reply->path());
});
