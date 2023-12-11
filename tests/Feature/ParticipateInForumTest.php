<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\ManageSingleThread;

test('an authenticated user may participate in Forum Threads', function () 
{
    loginAs(); 
    $thread= Thread::factory()->create();
    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->set('newReply', 'foo too')
        ->call('addThisReply');
    $this->assertTrue(Reply::whereBody('foo too')->exists());
});
test('a guest may not reply to Forum Threads', function () 
{
    $thread= Thread::factory()->create();
    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->assertDontSee('Enter your reply here !');
});
