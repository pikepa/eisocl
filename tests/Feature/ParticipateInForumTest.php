<?php

use App\Livewire\Threads\ManageSingleThread;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;

test('an authenticated user may participate in Forum Threads', function () {
    loginAs();
    $thread = Thread::factory()->create();
    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->assertOk()
        ->set('newReply', 'this is a reply')
        ->call('addThisReply');
    $this->assertTrue(Reply::whereBody('this is a reply')->exists());
    $this->assertEquals(1, $thread->fresh()->replies_count);
});

test('a guest may not reply to Forum Threads', function () {
    $thread = Thread::factory()->create();
    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->assertDontSee('Enter your reply here !');
});

it('tests the reply validation rules', function (string $field, mixed $value, string $rule) {
    loginAs();
    $thread = Thread::factory()->create();
    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->set($field, $value)
        ->call('addThisReply')
        ->assertHasErrors([$field => $rule]);
})->with([
    'body is null' => ['newReply', null, 'required'],
    'body is too long' => ['newReply', str_repeat('*', 2001), 'max'],
    'body is too short' => ['newReply', str_repeat('*', 2), 'min'],
]);

test('unauthorised users can not delete replies', function () {
    $this->withExceptionHandling();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->assertDontSee('Delete')
        ->call('deleteThisReply', [$reply->id])
       ->assertStatus(403);
});
test('an authorised users can delete replies', function () {
    LoginAs();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['user_id' => auth()->id(), 'thread_id' => $thread->id]);

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->assertSee('Delete')
        ->call('deleteThisReply', [$reply->id]);
    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    $this->assertEquals(0, $thread->fresh()->replies_count);
});
test('an authorised user can Edit the body of a reply', function () {
    LoginAs();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['user_id' => auth()->id(), 'thread_id' => $thread->id]);

    Livewire::test(ManageSingleThread::class, [$thread->id])
        ->assertSee('Edit')
        ->call('editReply', [$reply->id])
        ->assertSee('Save')
        ->assertSee($reply->body)
        ->set('replyEdit', 'Adjusted Reply')
        ->call('saveEdit', [$reply->id]);
    $this->assertDatabaseHAs('replies', ['id' => $reply->id, 'body' => 'Adjusted Reply']);
});

test('that replies containing spam may not be created', function () {
    loginAs();
    $thread = Thread::factory()->create();

    Livewire::test(ManageSingleThread::class, [$thread->id])
    ->assertOk()
    ->set('newReply', 'Yahoo Customer Support')
    ->call('addThisReply')
    ->assertHasErrors('newReply');
});
