<?php

use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\SubscribeButton;

it('a singend in user can subscribe to a thread', function () {
    LoginAs();
    $thread = Thread::factory()->create();
    
    Livewire::test(SubscribeButton::class,[$thread])
        ->call('subscribe');
    $this->assertDatabaseHas('thread_subscriptions',['thread_id' => $thread->id ]);
});
it('a singend in user can unsubscribe to a thread', function () {
    LoginAs();
    $thread = Thread::factory()->create();
    $thread->subscribe();
    Livewire::test(SubscribeButton::class,[$thread])
        ->call('subscribe');
    $this->assertEquals(0, $thread->subscriptions->count());
});
