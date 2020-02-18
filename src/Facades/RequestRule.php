<?php

namespace Bachilli\RequestRules\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bachilli\LaravelRequestRules\Skeleton\SkeletonClass
 */
class RequestRule extends Facade
{
    /**
     * @method static array resolveRules(array $mainRules, array $otherRules)
     * @method static \Bachilli\RequestRules\RuleEntity merge($requestClass, string $fieldName, string|null $validations = null)
     *
     * @see \Bachilli\RequestRules\Factory
     */
    protected static function getFacadeAccessor()
    {
        return 'request-rule';
    }
}
