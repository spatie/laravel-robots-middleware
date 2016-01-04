<?php

namespace Spatie\RobotsMiddleware;

use Closure;
use Illuminate\Http\Request;

class RobotsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (array_key_exists('x-robots-tag', $response->headers->all())) {
            return $response;
        }

        $response->header(
            'x-robots-tag',
            $this->shouldntBeIndexed($request) ? 'none' : 'all'
        );

        return $response;
    }

    protected function shouldntBeIndexed(Request $request) : bool
    {
        return false;
    }
}
