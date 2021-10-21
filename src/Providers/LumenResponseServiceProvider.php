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

class LumenResponseServiceProvider extends LaravelResponseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->configure('response');
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

        $this->mergeConfigFrom($path, 'response');
    }
}
