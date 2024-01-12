<?php

use App\Models\Reply;
use App\Models\User;

test('a user can fetch their most recent reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    $this->assertEquals($reply->id, $user->lastReply->id);
});
