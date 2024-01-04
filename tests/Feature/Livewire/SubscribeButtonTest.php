<?php

use App\Livewire\Threads\SubscribeButton;
use App\Models\Thread;
use Livewire\Livewire;

test('A guest user can not see the submit/unsubmit button', function () {
    $thread = Thread::factory()->create();

    $this->get(route('threads.single', [$thread->channel, $thread->id]))
    ->assertOk()
    ->assertDontSee('Unsubscribe')
    ->assertDontSee('Subscribe');
});
test('Only a signed in user can see the submit button', function () {
    LoginAs();
    $thread = Thread::factory()->create();

    $this->get(route('threads.single', [$thread->channel, $thread->id]))
    ->assertOk()
    ->assertSee('Subscribe')
    ->assertDontSee('Unsubscribe');
});

test('A signed in user can subscribe to a thread', function () {
    LoginAs();
    $thread = Thread::factory()->create();

    Livewire::test(SubscribeButton::class, [$thread])
        ->call('subscribe');
    $this->assertDatabaseHas('thread_subscriptions', ['thread_id' => $thread->id]);
});
test('A signed in user can unsubscribe to a thread', function () {
    LoginAs();
    $thread = Thread::factory()->create();
    $thread->subscribe();
    Livewire::test(SubscribeButton::class, [$thread])
        ->call('subscribe');
    $this->assertEquals(0, $thread->subscriptions->count());
});
