<?php

namespace FocusConcursos\SambatechLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string upload(string $path, array $metadata = [])
 * @method static array dumpConnection()
 *
 * @see \FocusConcursos\SambatechLaravel\Sambatech
 */
class Sambatech extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sambatech';
    }
}
