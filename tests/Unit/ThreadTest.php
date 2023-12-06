<?php

use App\Models\User;
use App\Models\Thread;

test('a thread has replies', function () {
    $thread = Thread::factory()->create();
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
});

test('a thread has a creator', function (){
    $thread = Thread::factory()->create();
    $this->assertInstanceOf(User::class, $thread->creator);
});