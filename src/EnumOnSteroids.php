<?php

declare(strict_types=1);

namespace Everully\LaravelEnumOnSteroids;

use BackedEnum;
use Illuminate\Support\Collection;

/**
 * @mixin BackedEnum
 */
trait EnumOnSteroids
{
    public function equals(string|BackedEnum $value): bool
    {
        return match (true) {
            $value instanceof self => $this->value === $value->value,
            is_string($value) => $this->value === $value,
            default => false,
        };
    }

    public static function values(): array
    {
        return array_map(
            fn (BackedEnum $enum) => $enum->value, static::cases()
        );
    }

    public static function names(): array
    {
        return array_map(
            fn (BackedEnum $enum) => $enum->name, static::cases()
        );
    }

    public static function collection(): Collection
    {
        return collect(static::cases());
    }

    public static function collect(array $items): Collection
    {
        return collect($items)
            ->map(fn (string|BackedEnum $item) => self::tryFromItem($item))
            ->filter();
    }

    public static function has(string|BackedEnum $item): bool
    {
        return match (true) {
            $item instanceof self => true,
            is_string($item) => boolval(static::tryFrom($item)),
            default => false,
        };
    }

    public static function hasAny(array $items): bool
    {
        return collect($items)->contains(
            fn (string|BackedEnum $item) => static::has($item)
        );
    }

    public static function hasAll(array $items): bool
    {
        return collect($items)->every(
            fn (string|BackedEnum $item) => static::has($item)
        );
    }

    protected static function tryFromItem(string|BackedEnum $item): ?self
    {
        return match (true) {
            $item instanceof self => $item,
            is_string($item) => static::tryFrom($item),
            default => null,
        };
    }
}
