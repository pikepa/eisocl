<?php

use App\Livewire\Threads\ManageSingleThread;
use App\Models\Thread;
use App\Models\User;
use Livewire\Livewire;

it('mentioned users in a reply are notified', function () {
    $john = User::factory()->create(['name' => 'JohnDoe']);
    loginAs($john);
    $jane = User::factory()->create(['name' => 'JaneDoe']);
    $thread = Thread::factory()->create();

    Livewire::test(ManageSingleThread::class, [$thread->id])
    ->set('newReply', '@JaneDoe look at this thread')
    ->call('addThisReply')
    ->assertOK();

    $this->assertCount(1, $jane->notifications);
});
