<?php

namespace Spatie\RobotsMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RobotsMiddleware
{
    /**
     * @var \Illuminate\Http\Response
     */
    protected $response;

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
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

    /**
     * @param string $contents
     *
     * @return \Illuminate\Http\Response
     */
    protected function responseWithRobots($contents)
    {
        $this->response->header('x-robots-tag', $contents);

        return $this->response;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool|string
     */
    protected function shouldIndex(Request $request)
    {
        return true;
    }
}
