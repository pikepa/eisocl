<?php

use App\Models\User;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\ManageSingleThread;

it('mentioned users in a reply are notified', function () {
    $john = User::factory()->create(['name' => 'JohnDoe']);
    loginAs($john);
    $jane = User::factory()->create(['name' => 'JaneDoe']);
    $thread = Thread::factory()->create();

    Livewire::test(ManageSingleThread::class, [$thread->id])
    ->set('newReply', '@JaneDoe look at this thread' )
    ->call('addThisReply')
    ->assertOK();

    $this->assertCount( 1, $jane->notifications);
});
