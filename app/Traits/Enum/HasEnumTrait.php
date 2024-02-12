<?php

namespace App\Traits\Enum;

trait HasEnumTrait
{
    /**
     * Get the enum values.
     *
     * @return array<string>
     */
    public static function getValues(): array
    {
        return array_values(static::toArray());
    }

    /**
     * Get the enum keys.
     *
     * @return array<string>
     */
    public static function getKeys(): array
    {
        return array_keys(static::toArray());
    }

    /**
     * Get the enum key-value pairs.
     *
     * @return array<string, string>
     */
    public static function getKeyValuePairs(): array
    {
        return static::toArray();
    }

    /**
     * Get the enum key-value pairs for select options.
     *
     * @return array<string, string>
     */
    public static function getSelectOptions(): array
    {
        return array_map(fn ($value) => ucwords(str_replace('_', ' ', $value)), static::toArray());
    }

    /**
     * Get the enum key-value pairs for select options.
     *
     * @return array<string, string>
     */
    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->name] = $case->value;
        }
        return $array;
    }
}
