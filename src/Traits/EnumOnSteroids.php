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
    public function equals(string|BackedEnum $value): bool
    {
        return $value instanceof BackedEnum
            ? $this->value === $value->value
            : $this->value === $value;
    }

    public static function values(): array
    {
        return array_map(
            fn(BackedEnum $enum) => $enum->value, static::cases()
        );
    }

    public static function names(): array
    {
        return array_map(
            fn(BackedEnum $enum) => $enum->name, static::cases()
        );
    }

    public static function collection(): Collection
    {
        return collect(static::cases());
    }

    public static function collect(array $items): Collection
    {
        return collect($items)
            ->map(fn(string|BackedEnum $item) => self::tryFromItem($item))
            ->filter();
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
