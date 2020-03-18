<?php

namespace LaravelCreative\JqueryActions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelCreative\JqueryActions\Skeleton\SkeletonClass
 */
class JqueryActionsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jquery-actions';
    }
}
