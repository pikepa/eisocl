<?php

use App\Models\Reply;
test('a guest can not favorite anything', function (){
    $this->post('replies/1/favorites' )
        ->assertRedirect('/login');
});

test('an authenticated user can favorite any reply', function () {
    loginAs();
    $this->withoutExceptionHandling();
    $reply = Reply::factory()->create();
    $this->post('/replies/' . $reply->id . '/favorites' );
    $this->assertCount(1, $reply->favorites);

});

test('an authenticated user may only favorite a reply once', function () {
    loginAs();
    $reply = Reply::factory()->create();
    $this->withoutExceptionHandling();
    try{
        $this->post('/replies/' . $reply->id . '/favorites' );
        $this->post('/replies/' . $reply->id . '/favorites' );
    }catch (\Exception $e) {
        $this->fail('Did not expect to insert the same record twice');
    }


    $this->assertCount(1, $reply->favorites);

});


