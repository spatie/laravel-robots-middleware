<?php

namespace Spatie\RobotsMiddleware;

use Closure;
use Illuminate\Http\Request;

class RobotsMiddleware
{
    protected $response;

    public function handle(Request $request, Closure $next)
    {
        $this->response = $next($request);

        if (array_key_exists('x-robots-tag', $this->response->headers->all())) {
            return $this->response;
        }

        $shouldIndex = $this->shouldIndex($request);

        if (is_bool($shouldIndex)) {
            return $this->responseWithRobots($shouldIndex ? 'all' : 'none');
        }

        if (is_string($shouldIndex)) {
            return $this->responseWithRobots($shouldIndex);
        }

        throw new InvalidIndexRule('An indexing rule needs to return a boolean or a string');
    }

    protected function responseWithRobots(string $contents)
    {
        $this->response->header('x-robots-tag', $contents);

        return $this->response;
    }

    /**
     * @return string|bool
     */
    protected function shouldIndex(Request $request)
    {
        return true;
    }
}
