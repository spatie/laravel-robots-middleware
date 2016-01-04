<?php

namespace Spatie\RobotsMiddleware\Test;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class TestMiddleware extends RobotsMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldntBeIndexed(Request $request)
    {
        return $request->segment(1) === 'go-away';
    }
}
