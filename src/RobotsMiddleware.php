<?php

namespace Spatie\RobotsMiddleware;

use Closure;
use Illuminate\Http\Request;

class RobotsMiddleware
{
    protected $response;
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->response = $next($request);

        $shouldIndex = $this->shouldIndex($request);

        if (is_bool($shouldIndex)) {
            return $this->responseWithRobots($shouldIndex ? 'all' : 'none');
        }

        if (is_string($shouldIndex)) {
            return $this->responseWithRobots($shouldIndex);
        }

        throw InvalidIndexRule::requiresBooleanOrString();
    }
    
    /**
     * @param $contents
     * @return mixed
     */
    protected function responseWithRobots(string $contents)
    {
        $this->response->headers->set('x-robots-tag', $contents, false);

        return $this->response;
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    protected function shouldIndex(Request $request)
    {
        return true;
    }
}
