<?php

namespace Spatie\RobotsMiddleware\Test;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class TestMiddleware extends RobotsMiddleware
{
    protected function shouldntBeIndexed(Request $request) : bool
    {
        return $request->segment(1) === 'go-away';
    }
}
