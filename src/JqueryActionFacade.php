<?php

namespace LaravelCreative\JqueryAction;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelCreative\JqueryAction\Skeleton\SkeletonClass
 */
class JqueryActionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jquery-action';
    }
}
