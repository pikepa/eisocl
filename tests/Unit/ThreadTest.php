<?php

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;

beforeEach(function () {
    $this->thread = Thread::factory()->create();
});

test('a thread can make a string path', function () {
    $this->assertEquals('/threads/'.$this->thread->channel->slug.'/'.$this->thread->id, $this->thread->path());
});

test('a thread has replies', function () {
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
});

test('a thread has a creator', function () {
    $this->assertInstanceOf(User::class, $this->thread->creator);
});

test('a thread can add a reply', function () {
    $this->thread->addReply([
        'body' => 'Foobar',
        'user_id' => 1,
    ]);
    $this->assertCount(1, $this->thread->replies);
});

test('A thread belongs to a channel', function () {
    $thread = Thread::factory()->create();
    $this->assertInstanceOf(Channel::class, $thread->channel);
});
