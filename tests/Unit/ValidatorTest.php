<?php

use Core\Validator;

it('validates a string', function () {
  expect(Validator::string('foobar'))->toBeTrue();
  expect(Validator::string(false))->toBeFalse();
  expect(Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum lenght', function () {
  expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
  expect(Validator::email('foobar'))->toBeFalse();
  expect(Validator::email('foobar@examole.com'))->toEqual('foobar@examole.com');
});

it('validates that a number is greater than a given amount', function () {
  expect(Validator::greaterThan(10, 1))->toBeTrue();
  expect(Validator::greaterThan(10, 100))->toBeFalse();
})->only();