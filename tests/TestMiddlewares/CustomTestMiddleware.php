<?php

namespace Spatie\RobotsMiddleware\Test\TestMiddlewares;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class CustomTestMiddleware extends RobotsMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function shouldIndex(Request $request)
    {
        if ($request->segment(1) === 'custom-tag') {
            return 'nofollow';
        }

        return 'all';
    }
}
