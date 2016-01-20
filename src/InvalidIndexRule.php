<?php

namespace Spatie\RobotsMiddleware;

use Exception;

class InvalidIndexRule extends Exception
{
    public static function requiresBooleanOrString()
    {
        return new static('An indexing rule needs to return a boolean or a string.');
    }
}
