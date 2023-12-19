<?php

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;

test('it records activity when a thread is created', function () {
    LoginAs();
    $thread = Thread::factory()->create();

    $this->assertDatabaseHas('activities', [
        'type' => 'created_thread',
        'user_id' => auth()->id(),
        'subject_id' => $thread->id,
        'subject_type' => 'App\Models\Thread',
    ]);
    $activity = Activity::first();
    $this->assertEquals($activity->subject->id, $thread->id);
});

test('it records activity when a reply is created', function () {
    LoginAs();
    $reply = Reply::factory()->create();
    $this->AssertEquals(2, Activity::count());
});
