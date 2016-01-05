<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class CustomTestMiddleware extends RobotsMiddleware
{
    /**
     * @return string|bool
     */
    protected function shouldIndex(Request $request)
    {
        if ($request->segment(1) === 'custom-tag') {
            return 'nofollow';
        }

        return 'all';
    }
}
