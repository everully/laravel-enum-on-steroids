<?php

declare(strict_types=1);

namespace Everully\LaravelOnSteroids\Traits;

use BackedEnum;
use Illuminate\Support\Collection;

/**
 * @mixin BackedEnum
 */
trait EnumOnSteroids
{
    public function equals(BackedEnum $enum): bool
    {
        return $this->value === $enum->value;
    }

    public static function values(): array
    {
        return array_map(
            fn (BackedEnum $enum) => $enum->value, static::cases()
        );
    }

    public static function collection(): Collection
    {
        return collect(static::cases());
    }
}
