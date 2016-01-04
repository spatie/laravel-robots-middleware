<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class SimpleTestMiddleware extends RobotsMiddleware
{
    protected function shouldIndex(Request $request) : bool
    {
        return $request->segment(1) !== 'go-away';
    }
}
