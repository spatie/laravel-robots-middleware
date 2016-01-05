<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class SimpleTestMiddleware extends RobotsMiddleware
{
    /**
     * @return string|bool
     */
    protected function shouldIndex(Request $request)
    {
        return $request->segment(1) !== 'go-away';
    }
}
