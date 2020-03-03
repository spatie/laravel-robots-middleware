<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class InvalidTestMiddleware extends RobotsMiddleware
{
    protected function shouldIndex(Request $request): array
    {
        return [];
    }
}
