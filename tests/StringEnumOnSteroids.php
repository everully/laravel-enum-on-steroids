<?php

declare(strict_types=1);

use Everully\LaravelOnSteroids\Tests\Support\IntegerEnum;
use Everully\LaravelOnSteroids\Tests\Support\StringEnum;
use Illuminate\Support\Collection;

it('returns true if provided object is equal to main object', function () {
    // Act & Assert
    expect(
        StringEnum::A->equals(StringEnum::A)
    )->toBeTrue();
});

it('returns false if provided object is not equal to main object', function () {
    expect(
        StringEnum::A->equals(StringEnum::B)
    )->toBeFalse();
});

it('returns true if provided string is equal to main object', function () {
    // Act & Assert
    expect(
        StringEnum::A->equals('a')
    )->toBeTrue();
});

it('returns false if provided string is not equal to main object', function () {
    expect(
        StringEnum::A->equals('b')
    )->toBeFalse();
});

it('returns an array of values', function () {
    // Act & Assert
    expect(
        StringEnum::values()
    )->toBe(['a', 'b', 'c']);
});

it('returns an array of names', function () {
    // Act & Assert
    expect(
        StringEnum::names()
    )->toBe(['A', 'B', 'C']);
});

it('returns a Laravel collection', function () {
    // Act & Assert
    expect(
        StringEnum::collection()
    )->toBeInstanceOf(Collection::class)
        ->toHaveCount(3)
        ->contains(StringEnum::A)->toBeTrue()
        ->contains(StringEnum::B)->toBeTrue()
        ->contains(StringEnum::C)->toBeTrue();
});

it('collects objects from array and return Laravel collection', function () {
    // Act & Assert
    expect(
        StringEnum::collect([StringEnum::A, StringEnum::B])
    )->toBeInstanceOf(Collection::class)
        ->toHaveCount(2)
        ->contains(StringEnum::A)->toBeTrue()
        ->contains(StringEnum::B)->toBeTrue();
});

it('does not include not valid objects', function () {
    // Act & Assert
    expect(
        StringEnum::collect([StringEnum::A, IntegerEnum::B])
    )->toBeInstanceOf(Collection::class)
        ->toHaveCount(1)
        ->contains(StringEnum::A)->toBeTrue();
});

it('returns empty collection if non of objects are valid', function () {
    // Act & Assert
    expect(
        StringEnum::collect([IntegerEnum::B])
    )->toBeInstanceOf(Collection::class)
        ->toBeEmpty();
});

it('collects strings from array and return Laravel collection', function () {
    // Act & Assert
    expect(
        StringEnum::collect(['a', 'b'])
    )->toBeInstanceOf(Collection::class)
        ->toHaveCount(2)
        ->contains(StringEnum::A)->toBeTrue()
        ->contains(StringEnum::B)->toBeTrue();
});

it('does not include not valid strings', function () {
    // Act & Assert
    expect(
        StringEnum::collect(['a', 'b', 'e'])
    )->toBeInstanceOf(Collection::class)
        ->toHaveCount(2)
        ->contains(StringEnum::A)->toBeTrue()
        ->contains(StringEnum::B)->toBeTrue();
});

it('returns empty collection if non of strings are valid', function () {
    // Act & Assert
    expect(
        StringEnum::collect(['invalid'])
    )->toBeInstanceOf(Collection::class)
        ->toBeEmpty();
});
