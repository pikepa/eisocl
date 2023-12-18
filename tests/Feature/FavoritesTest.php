<?php

use App\Livewire\Threads\ManageSingleThread;
use App\Models\Thread;
use Livewire\Livewire;

test('a guest can not favorite anything is redirected to login', function () {
    $thread = Thread::factory()
                ->hasReplies(1)
                ->create();
    $reply = $thread->replies()->first();
    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->call('addFavorite', [$reply->id])
        ->assertRedirect('/login');
});

test('an authenticated user can favorite any reply', function () {
    loginAs();
    $thread = Thread::factory()
                ->hasReplies(1)
                ->create();
    $reply = $thread->replies()->first();

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->call('addFavorite', [$reply->id]);
    $this->assertDatabaseHas('favorites',
        ['favorited_id' => $reply->id,
            'user_id' => auth()->user()->id,
            'favorited_type' => 'App\Models\Reply', ]);
});

test('an authenticated user may only favorite a reply once', function () {
    loginAs();
    $thread = Thread::factory()
            ->hasReplies(1)
            ->create();
    $reply = $thread->replies()->first();

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->call('addFavorite', [$reply->id])
        ->call('addFavorite', [$reply->id]);

    $this->assertDatabaseCount('favorites', 1);
});
