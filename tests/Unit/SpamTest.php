<?php

use App\Inspections\Spam;

it('checks for invalid keywords', function () {
        $spam = new Spam();
        $this->assertFalse($spam->detect('Innocent Reply here'));
        $this->expectException('Exception');
        $spam->detect('yahoo customer support');
    });

it('checks for any key being held down', function () {
    $spam = new Spam();
    $this->expectException('Exception');
    $spam->detect('Hello World zzzzzzzzzzzzzz');
});
