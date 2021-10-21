<?php

namespace Witcier\LaravelResponse\Providers;

/*
 * This file is part of the Witcier/laravel-response.
 *
 * (c) Witcier <770201276@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\ServiceProvider;

class LaravelResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupConfig();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function setupConfig()
    {
        $path = dirname(__DIR__, 2).'/config/response.php';

        if ($this->app->runningInConsole()) {
            $this->publishes([$path => config_path('response.php')], 'response');
        }

        $this->mergeConfigFrom($path, 'response');
    }
}
