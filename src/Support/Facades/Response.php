<?php

namespace Witcier\LaravelResponse\Support\Traits;

/*
 * This file is part of the Witcier/laravel-response.
 *
 * (c) Witcier <770201276@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Response extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return \Witcier\LaravelResponse\Response::class;
    }
}
