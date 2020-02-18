<?php

namespace Bachilli\RequestRules\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bachilli\LaravelRequestRules\Skeleton\SkeletonClass
 */
class RequestRule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'request-rule';
    }
}
