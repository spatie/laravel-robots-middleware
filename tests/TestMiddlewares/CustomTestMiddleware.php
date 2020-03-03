<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class CustomTestMiddleware extends RobotsMiddleware
{
    protected function shouldIndex(Request $request): string
    {
        if ($request->segment(1) === 'custom-tag') {
            return 'nofollow';
        }

        return 'all';
    }
}
