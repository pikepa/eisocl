<?php

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use App\Notifications\ThreadWasUpdated;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Notification;

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

test('a thread notifies all registered subscribers when a reply is added', function () {
    Notification::fake();
    loginAs();
    $this->thread->subscribe()->addReply([
        'body' => 'Foobar',
        'user_id' => 999,
    ]);
    Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
});

test('A thread belongs to a channel', function () {
    $thread = Thread::factory()->create();
    $this->assertInstanceOf(Channel::class, $thread->channel);
});

test('A thread can be subscribed to', function () {
    //given we have a thread
    $thread = Thread::factory()->create();
    // when the user subscribes to the thread
    $thread->subscribe($userId = 1);
    // Then we should be able to fetch all threads the user is subscribeed to
    $this->assertEquals(
        1,
        $thread->subscriptions()->where('user_id', $userId)->count());
});

test('a thread can be unsubscribed from', function () {
    // given we have a thread
    $thread = Thread::factory()->create();
    // and a user who is subscribed to the thread
    $thread->subscribe($userId = 1);
    // now wants to be unsubscribed
    $thread->unsubscribe($userId);
    // should result in a count of zero subscriptions
    $this->assertCount(0, $thread->subscriptions);
});

test('a thread can check if an authenticated user has read all replies', function () {
    loginAs();
    $thread = Thread::factory()->create();
    //note tap(auth()->user() to simplify all threee lines)
    tap(auth()->user(), function ($user) use ($thread) {
        $this->assertTrue($thread->hasUpdatesFor($user));
        //simulate visit to Thread
        $user->read($thread);
        $this->assertFalse($thread->hasUpdatesFor($user));
    });
});

test('leaving a reply marks thread as unread', function () {
    loginAs();

    $user = auth()->user();

    $user->read($this->thread);

    Carbon::setTestNow(Carbon::now()->add(CarbonInterval::days(1)));

    $this->thread->addReply([
        'user_id' => 999,
        'body' => 'Some reply here',
    ]);

    $this->thread = $this->thread->fresh();

    $this->assertTrue($this->thread->hasUpdatesFor($user));
});

    test('adding a reply updates the thread updatedated_field', function () {
        $one = $this->thread->updated_at;

        Carbon::setTestNow(Carbon::now()->add(CarbonInterval::days(1)));

        $this->thread->addReply([
            'user_id' => 999,
            'body' => 'Some reply here',
        ]);

        $two = $this->thread->fresh()->updated_at;

        $this->assertNotTrue($one->equalTo($two));
    });
    afterAll(function () {
        // Clean testing data after all tests run...
        Carbon::setTestNow();
    });
