<?php

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
use Carbon\Carbon;

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

test('An activity page can be loaded by a user ', function () {
    LoginAs();
    Thread::factory()->count(2)->create(['user_id' => auth()->id()]);
    auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subweek()]);

    $feed = (Activity::feed(auth()->user()));
    $this->assertTrue($feed->keys()->contains(Carbon::now()->format('Y-m-d')));

    $this->assertTrue($feed->keys()->contains(Carbon::now()->subWeek()->format('Y-m-d')));
});
