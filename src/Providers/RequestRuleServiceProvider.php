<?php

namespace Bachilli\RequestRules\Providers;

use Bachilli\RequestRules\RequestRule;
use Illuminate\Support\ServiceProvider;

class RequestRuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('request-rule', function () {
            return new RequestRule;
        });
    }
}
