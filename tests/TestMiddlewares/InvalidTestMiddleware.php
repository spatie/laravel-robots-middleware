<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class InvalidTestMiddleware extends RobotsMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function shouldIndex(Request $request)
    {
        return [];
    }
}
