<?php

namespace Spatie\RobotsMiddleware\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\RobotsMiddleware\Test\TestMiddlewares\CustomTestMiddleware;
use Spatie\RobotsMiddleware\Test\TestMiddlewares\SimpleTestMiddleware;
use Spatie\RobotsMiddleware\Test\TestMiddlewares\InvalidTestMiddleware;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDummyRoutes();
    }

    protected function setUpDummyRoutes()
    {
        $this->app['router']->group(
            ['middleware' => SimpleTestMiddleware::class],
            function () {
                $this->app['router']->get('behold-me', function () {
                    return 'Hello world!';
                });

                $this->app['router']->get('go-away', function () {
                    return 'Hello world!';
                });

                $this->app['router']->get('dont-follow-me', function () {
                    return response('Hello world!')->header('x-robots-tag', 'nofollow');
                });
            }
        );

        $this->app['router']->group(
            ['middleware' => CustomTestMiddleware::class],
            function () {
                $this->app['router']->get('custom-tag', function () {
                    return 'Hello world!';
                });
            }
        );

        $this->app['router']->group(
            ['middleware' => InvalidTestMiddleware::class],
            function () {
                $this->app['router']->get('invalid-middleware', function () {
                    return 'Hello world!';
                });
            }
        );
    }
}
