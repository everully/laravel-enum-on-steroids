<?php

declare(strict_types=1);

use Everully\LaravelOnSteroids\Tests\Support\CopyStringEnum;
use Everully\LaravelOnSteroids\Tests\Support\IntegerEnum;
use Everully\LaravelOnSteroids\Tests\Support\StringEnum;
use Illuminate\Support\Collection;

it('checks if provided object or string are equal to main object', function () {
    // Act & Assert
    expect(StringEnum::A->equals(StringEnum::A))->toBeTrue()
        ->and(StringEnum::A->equals('a'))->toBeTrue()
        ->and(StringEnum::A->equals(StringEnum::B))->toBeFalse()
        ->and(StringEnum::A->equals(CopyStringEnum::A))->toBeFalse()
        ->and(StringEnum::A->equals('b'))->toBeFalse();

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

it('checks if enum has provided string or object', function () {
    // Act & Assert
    expect(StringEnum::has('a'))->toBeTrue()
        ->and(StringEnum::has(StringEnum::A))->toBeTrue()
        ->and(StringEnum::has('invalid'))->toBeFalse()
        ->and(StringEnum::has(CopyStringEnum::A))->toBeFalse();
});
