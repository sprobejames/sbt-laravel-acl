<?php

namespace Sprobe\Acl;

use Illuminate\Support\ServiceProvider;

class SprobeAclServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // load config files
        $this->mergeConfigFrom(__DIR__ . '/config/permission.php', 'permission');
        $this->mergeConfigFrom(__DIR__ . '/config/resource.php', 'resource');

        // register the middleware to the router
        $this->app['router']->pushMiddlewareToGroup('acl', \Sprobe\Acl\Http\Middleware\Acl::class);

        // register migrations for this package
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
    }
}
