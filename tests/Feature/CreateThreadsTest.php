<?php

use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\ManageThreads;

test('an authenticated user can create a new forum thread', function () {
   loginAs();
   $thread=Thread::factory()->create();
   Livewire::test(ManageThreads::class)
        ->set('newThreadTitle', $thread->title)
        ->set('newThreadBody', $thread->body)
        ->set('channelId', $thread->channel_id)
        ->call('addNewThread');
        $this->assertDatabaseCount('threads', 2);
        $this->assertDatabaseHas('threads',['title' => $thread->title]);
});
test('a guest may not create a Forum Thread', function () 
{
    Livewire::test(ManageThreads::class)
        ->assertDontSee('Enter the new thread title');
});

it('tests the thread validation rules', function (string $field, mixed $value, string $rule) {
    loginAs();
    Livewire::test(ManageThreads::class)
        ->set($field, $value)
        ->call('addNewThread')
        ->assertHasErrors([$field => $rule]);
})->with([
    'title is null' => ['newThreadTitle', null, 'required'],
    'title is too long' => ['newThreadTitle', str_repeat('*', 201), 'max'],
    'title is too short' => ['newThreadTitle', str_repeat('*', 2), 'min'],
    'body is null' => ['newThreadBody', null, 'required'],
    'body is too long' => ['newThreadBody', str_repeat('*', 251), 'max'],
    'body is too short' => ['newThreadBody', str_repeat('*', 2), 'min'],
]);