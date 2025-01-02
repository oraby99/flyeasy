<?php

namespace App\Enums;

use ReflectionClass;

class Enum
{
    public static function getName($value): int|string|null
    {
        $constants = array_flip((new ReflectionClass(static::class))->getConstants());

        return $constants[$value] ?? null;
    }

    public static function getValue($name)
    {
        $constants = (new ReflectionClass(static::class))->getConstants();

        return array_key_exists($name, $constants) ? $constants[$name] : null;
    }

    public static function getValues(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        return array_values($reflectionClass->getConstants());
    }

    public static function getNames(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        return array_keys($reflectionClass->getConstants());
    }

    public static function getNamesAndValues(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        return $reflectionClass->getConstants();
    }
}
