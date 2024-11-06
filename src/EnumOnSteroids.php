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
    public function equals(int|string|BackedEnum $value): bool
    {
        return match (true) {
            $value instanceof self => $this->value === $value->value,
            is_string($value) => $this->value === $value,
            default => false,
        };
    }

    public function oneOf(array|int|string|BackedEnum $items): bool
    {
        foreach ((array) $items as $item) {
            if ($this->equals($item)) {
                return true;
            }
        }

        return false;
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

    public static function collect(iterable $items): Collection
    {
        $enums = [];
        foreach ($items as $item) {
            $enum = static::tryFromItem($item);
            if ($enum !== null) {
                $enums[] = $enum;
            }
        }

        return collect($enums);
    }

    public static function has(int|string|BackedEnum $item): bool
    {
        return match (true) {
            $item instanceof self => true,
            is_string($item) => boolval(static::tryFrom($item)),
            default => false,
        };
    }

    public static function hasAny(iterable $items): bool
    {
        foreach ($items as $item) {
            if (static::has($item)) {
                return true;
            }
        }

        return false;
    }

    public static function hasAll(iterable $items): bool
    {
        foreach ($items as $item) {
            if ( ! static::has($item)) {
                return false;
            }
        }

        return true;
    }

    public static function fromOrDefault(int|string $value, ?self $default = null): ?static
    {
        return static::tryFrom($value) ?? $default;
    }

    protected static function tryFromItem(int|string|BackedEnum $item): ?static
    {
        return match (true) {
            $item instanceof self => $item,
            is_string($item) => static::tryFrom($item),
            default => null,
        };
    }
}
