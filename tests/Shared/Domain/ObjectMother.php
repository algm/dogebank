<?php

namespace Tests\Shared\Domain;

use Faker\Factory;
use Faker\Generator;

abstract class ObjectMother
{
    public static ?Generator $generator = null;

    public static function generator(): Generator
    {
        if (empty(static::$generator)) {
            static::$generator = Factory::create();
        }

        return static::$generator;
    }
}
