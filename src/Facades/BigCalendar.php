<?php

namespace OpenHands\BigCalendar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OpenHands\BigCalendar\BigCalendar
 */
class BigCalendar extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \OpenHands\BigCalendar\BigCalendar::class;
    }
}
