<?php

namespace LaravelCreative\JqueryActions\Tests;

use Orchestra\Testbench\TestCase;
use LaravelCreative\JqueryActions\JqueryActionsServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [JqueryActionsServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
