<?php

use App\Models\Thread;
use App\Models\Channel;

test('a channel consists of threads', function () {
    $channel =Channel::factory()->create();
    $thread = Thread::factory()->create(['channel_id' => $channel->id]);
    $this->assertTrue($channel->threads->contains($thread));
});
