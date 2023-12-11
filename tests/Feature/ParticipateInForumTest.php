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

it('tests the reply validation rules', function (string $field, mixed $value, string $rule) {
    loginAs();
    $thread= Thread::factory()->create();
    Livewire::test(ManageSingleThread::class,[$thread->id])
        ->set($field, $value)
        ->call('addThisReply')
        ->assertHasErrors([$field => $rule]);
})->with([
    'body is null' => ['newReply', null, 'required'],
    'body is too long' => ['newReply', str_repeat('*', 251), 'max'],
    'body is too short' => ['newReply', str_repeat('*', 2), 'min'],
]);
