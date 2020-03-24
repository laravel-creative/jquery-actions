<?php

namespace LaravelCreative\JqueryAction\Tests;

use Orchestra\Testbench\TestCase;
use LaravelCreative\JqueryAction\JqueryActionServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [JqueryActionServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
