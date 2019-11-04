# Enable or disable the indexing of your app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-robots-middleware.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-robots-middleware)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-robots-middleware/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-robots-middleware)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/b214dd86-16cd-433e-934f-1b9216139cef.svg?style=flat-square)](https://insight.sensiolabs.com/projects/b214dd86-16cd-433e-934f-1b9216139cef)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-robots-middleware.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-robots-middleware)
[![StyleCI](https://styleci.io/repos/49018008/shield?branch=master)](https://styleci.io/repos/49018008)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-robots-middleware.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-robots-middleware)

A tiny, opinionated package to enable or disable indexing your site via a middleware in Laravel.

More on the Robots meta tag: https://developers.google.com/webmasters/control-crawl-index/docs/robots_meta_tag

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Installation

You can install the package via composer:
``` bash
$ composer require spatie/laravel-robots-middleware
```

## Usage

By default, the middleware enables indexing on all pages. You'll probably want to inherit your own class containing you application's indexing rule handler.  

```php
// app/Http/Middleware/MyRobotsMiddleware.php

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class MyRobotsMiddleware extends RobotsMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return string|bool
     */
    protected function shouldIndex(Request $request)
    {
        return $request->segment(1) !== 'admin';
    }
}
```

Next, simply register the newly created class in your middleware stack. 

```php
// app/Http/Kernel.php

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
        \App\Http\Middleware\MyRobotsMiddleware::class,
    ];
    
    // ...
}
```

That's it! Responses will now always have an `x-robots-tag` in their headers, containing an `all` or `none` value.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details. Due to nature of this package, there's a fair chance features won't be accepted to keep it light and opinionated.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
