<?php

use App\Models\Thread;
use App\Livewire\Threads\ManageThreads;
use App\Livewire\Threads\ManageSingleThread;
test('The home page gives a successful response', function () {
    $this->get('/')->assertStatus(200)
        ->assertSee('Ephraim Island Social Club');
});

test('The threads page is loaded with the threads.index route', function () {
    loginAs();
    $this->get(route('threads.index'))
        ->assertStatus(200)
        ->assertSeeLivewire(ManageThreads::class)
        ->assertSee('Ephraim Island Social Club Forum');
});
test('The single thread page is loaded with the threads.single route', function () {
    loginAs();
    $thread = Thread::factory()->create();
    $this->get(route('threads.single',[$thread->channel,$thread->id]))
        ->assertStatus(200)
        ->assertSeeLivewire(ManageSingleThread::class);
});
