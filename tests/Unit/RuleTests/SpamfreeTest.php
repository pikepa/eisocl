<?php

use App\Rules\Spamfree;

it('checks for normal sentences', function () {
    expect(new Spamfree())->toPassWith('This is a valid text entry');
});
it('checks for repeated keys', function () {
    expect(new Spamfree())->not()->toPassWith('Hello World zzzzzzzzzzzzzz');
});
it('checks for spam terms as defined in the rule', function () {
    expect(new Spamfree())->not()->toPassWith('yahoo customer support');
});
