<?php

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;

beforeEach(function () {
    loginAs();
    $this->thread = Thread::factory()->create();
});
test('a user can read all threads', function () {
    $this->get(route('threads.index'))
    ->assertOk()
    ->assertSee($this->thread->title)
    ->assertSee($this->thread->body);
});
test('a user can read a single thread', function () {
    $this->get(route('threads.single', [$this->thread->channel, $this->thread->id]))
    ->assertOk()
    ->assertSee($this->thread->title)
    ->assertSee($this->thread->body);
});

test('a User can read a single thread with associated replies', function () {
    $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);
    $this->get(route('threads.single', [$this->thread->channel, $this->thread->id]))
    ->assertOk()
    ->assertSee($reply->owner->name)
    ->assertSee($reply->body);
});

test('a user can filter threads according to a channel', function () {
    $channel = Channel::factory()->create();
    $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
    $threadNotInChannel = Thread::factory()->create();

    $this->get('/threads/'.$channel->slug)
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel->title);
});
