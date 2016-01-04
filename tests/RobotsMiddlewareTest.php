<?php

namespace Spatie\RobotsMiddleware\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\RobotsMiddleware\InvalidIndexRule;
use Spatie\RobotsMiddleware\Test\TestMiddlewares\CustomTestMiddleware;
use Spatie\RobotsMiddleware\Test\TestMiddlewares\InvalidTestMiddleware;
use Spatie\RobotsMiddleware\Test\TestMiddlewares\SimpleTestMiddleware;

class RobotsMiddlewareTest extends Orchestra
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpDummyRoutes();
    }

    public function test_it_always_adds_a_robots_header_tag()
    {
        $testRoutes = ['behold-me', 'go-away'];

        foreach ($testRoutes as $testRoute) {
            $headers = $this->call('get', $testRoute)->headers->all();
            $this->assertArrayHasKey('x-robots-tag', $headers);
        }
    }

    public function test_it_sets_the_robots_header_to_all_when_it_should_index()
    {
        $headers = $this->call('get', 'behold-me')->headers->all();
        $this->assertEquals('all', $headers['x-robots-tag'][0]);
    }

    public function test_it_sets_the_robots_header_to_none_when_it_shouldnt_index()
    {
        $headers = $this->call('get', 'go-away')->headers->all();
        $this->assertEquals('none', $headers['x-robots-tag'][0]);
    }

    public function test_it_doesnt_overwrite_previously_set_tags()
    {
        $headers = $this->call('get', 'dont-follow-me')->headers->all();
        $this->assertEquals('nofollow', $headers['x-robots-tag'][0]);
    }

    public function test_it_can_set_a_custom_tag_via_a_string()
    {
        $headers = $this->call('get', 'custom-tag')->headers->all();
        $this->assertEquals('nofollow', $headers['x-robots-tag'][0]);
    }

    public function test_it_doesnt_accept_invalid_middleware_rules()
    {
        $this->setExpectedException(InvalidIndexRule::class);

        $this->call('get', 'invalid-middleware')->headers->all();
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
