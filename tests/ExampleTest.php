<?php

namespace Bachilli\LaravelRequestRules\Tests;

use Orchestra\Testbench\TestCase;
use Bachilli\LaravelRequestRules\RequestRuleServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [RequestRuleServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
