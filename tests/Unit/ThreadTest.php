<?php

use App\Models\User;
use App\Models\Thread;
beforeEach(function()
{
    $this->thread = Thread::factory()->create();
});

test('a thread has replies', function () {
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
});

test('a thread has a creator', function (){
    $this->assertInstanceOf(User::class, $this->thread->creator);
});

test('a thread can add a reply', function(){
    $this->thread->addReply([
        'body' => 'Foobar',
        'user_id' => 1
    ]);
    $this->assertCount(1, $this->thread->replies);
});