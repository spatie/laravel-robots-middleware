<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class SimpleTestMiddleware extends RobotsMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldIndex(Request $request)
    {
        return $request->segment(1) !== 'go-away';
    }
}
