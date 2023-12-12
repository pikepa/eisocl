<?php

use App\Models\Reply;
use App\Models\User;

test('it has an owner', function () {
    $reply = Reply::factory()->create();
    $this->assertInstanceOf(User::class, $reply->owner);
});
