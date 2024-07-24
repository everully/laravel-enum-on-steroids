<?php

declare(strict_types=1);

use Everully\LaravelOnSteroids\Tests\Support\StringEnum;
use Illuminate\Support\Collection;

it('returns true if objects are equal', function () {
    // Act & Assert
    expect(
        StringEnum::A->equals(StringEnum::A)
    )->toBeTrue();
});

it('returns false if objects are not equal', function () {
    expect(
        StringEnum::A->equals(StringEnum::B)
    )->toBeFalse();
});

it('returns an array of values', function () {
    // Act & Assert
    expect(
        StringEnum::values()
    )->toBe(['a', 'b', 'c']);
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
