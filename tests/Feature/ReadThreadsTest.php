<?php

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;

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

    test('a user can filter threads by any user name', function () {
        //Arrange
        loginAs(User::factory()->create(['name' => 'JohnDoe']));
        $threadbyJohnDoe = Thread::factory()->create(['user_id' => auth()->id()]);
        $threadNotByJohnDoe = Thread::factory()->create();
        //Act & Assert
        $this->get('threads?by=JohnDoe')
            ->assertSee($threadbyJohnDoe->title)
            ->assertDontSee($threadNotByJohnDoe->title);
    });

    test('a user can filter threads by popularity', function () {
        $threadWithThreeReplies = Thread::factory()
            ->hasReplies(3)
            ->create();
        $threadWithTwoReplies = Thread::factory()
            ->hasReplies(2)
            ->create();
        $threadWithNoReplies = $this->thread;
        $this->get('/threads?popular=1')
            ->assertSeeInOrder([
                $threadWithThreeReplies->title,
                $threadWithTwoReplies->title,
                $threadWithNoReplies->title,
            ]);
    });
    test('a user can filter threads by those that are unanswered', function () {
        $threadWithAnswer = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $threadWithAnswer->id]);

        $this->get('/threads?unanswered=1')
        ->assertSee($this->thread->title)
        ->assertDontSee($threadWithAnswer->title);
    });
