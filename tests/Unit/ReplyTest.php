<?php

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Carbon\Carbon;

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

it('knows if it was just published', function () {
    $reply = Reply::factory()->create();
    $this->assertTrue($reply->wasJustPublished());
    $reply->created_at = Carbon::now()->subMonth();
    $this->assertFalse($reply->wasJustPublished());
});
it('can detect all mentioned users in the reply body', function () {
    $reply = Reply::factory()->create([
        'body' => '@JaneDoe wants to talk to @JohnDoe',
    ]);
    $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());
});
