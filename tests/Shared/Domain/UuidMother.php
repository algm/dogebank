<?php


namespace Tests\Shared\Domain;

use Illuminate\Support\Str;

abstract class UuidMother
{
    public static function random(): string
    {
        return Str::uuid()->toString();
    }
}

