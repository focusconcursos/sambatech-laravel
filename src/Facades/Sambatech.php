<?php

namespace FocusConcursos\SambatechLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Sambatech extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sambatech';
    }
}
