<?php

use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\ManageThreads;

test('an authenticated user can create a new forum thread', function () {
   loginAs();
   $thread=Thread::factory()->make();
   Livewire::test(ManageThreads::class)
        ->set('newThreadTitle', $thread->title)
        ->set('newThreadBody', $thread->body)
        ->call('addNewThread');
        $this->assertDatabaseCount('threads', 1);
        $this->assertDatabaseHas('threads',['title' => $thread->title]);
});
test('a guest may not create a Forum Thread', function () 
{
    Livewire::test(ManageThreads::class)
        ->assertDontSee('Enter the new thread title');
});