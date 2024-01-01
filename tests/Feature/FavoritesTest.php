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
        ->call('toggleFavorite', [$reply->id])
        ->assertRedirect('/login');
});

test('an authenticated user can favorite any reply', function () {
    loginAs();
    $thread = Thread::factory()
                ->hasReplies(1)
                ->create();
    $reply = $thread->replies()->first();

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->call('toggleFavorite', [$reply->id]);
    $this->assertDatabaseHas('favorites',
        ['favorited_id' => $reply->id,
            'user_id' => auth()->user()->id,
            'favorited_type' => 'App\Models\Reply', ]);
});

test('an authenticated user may unfavorite a reply ', function () {
    loginAs();
    $thread = Thread::factory()
            ->hasReplies(1)
            ->create();
    $reply = $thread->replies()->first();
    $this->assertDatabaseCount('activities', 2);

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->call('toggleFavorite', [$reply->id])
        ->call('toggleFavorite', [$reply->id]);

    $this->assertDatabaseCount('favorites', 0);
    $this->assertDatabaseCount('activities', 2);
});
