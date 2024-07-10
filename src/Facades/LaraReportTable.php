<?php

namespace Christoferd\LaraReportTable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Christoferd\LaraReportTable\LaraReportTable
 */
class LaraReportTable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Christoferd\LaraReportTable\LaraReportTable::class;
    }
}
