<?php
use App\Models\User;
use App\Models\Reply;
test('it has an owner', function () {
    $reply = Reply::factory()->create();
    $this->assertInstanceOf(User::class, $reply->owner);
});
