<?php

use App\Livewire\Notifications\ShowUserNotifications;
use App\Models\Thread;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    loginAs();
    $this->thread = Thread::factory()->create()->subscribe();
    $this->assertCount(0, auth()->user()->notifications);
});
test('a notification is prepared when a subscribed thread receives a new reply that is not by the current user', function () {
    //User 1 replying to thread - no need for notification.
    $this->thread->addReply([
        'user_id' => auth()->id(),
        'body' => 'Some reply here',
    ]);
    // No notification for user1 added
    $this->assertCount(0, auth()->user()->unreadNotifications);

    //a third user adds a reply to the same thread - so User 1 should get a notification
    $this->thread->addReply([
        'user_id' => User::factory()->create()->id,
        'body' => 'Some new reply here',
    ]);
    $this->assertCount(1, auth()->user()->fresh()->unreadNotifications);
});

test('a user can fetch their unread notifications', function () {
    $this->thread->addReply([
        'user_id' => User::factory()->create()->id,
        'body' => 'Some reply here',
    ]);
    Livewire::test(ShowUserNotifications::class)
     ->assertStatus(200)
     //as part of the dropdown for notifications should see the follwing.
     ->assertSee($this->thread->title)
     ->assertSee($this->thread->path());
});

test('a user can mark a notification as read', function () {
    $this->thread->addReply([
        'user_id' => User::factory()->create()->id,
        'body' => 'Some reply here',
    ]);
    $this->assertCount(1, auth()->user()->unreadNotifications);

    Livewire::test(ShowUserNotifications::class)
        ->assertStatus(200)
        ->call('markAsRead', auth()->user()->unreadNotifications->first()->id);

    $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);
});
