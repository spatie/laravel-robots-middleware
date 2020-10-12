# Enable or disable the indexing of your app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-robots-middleware.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-robots-middleware)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/spatie/laravel-robots-middleware/run-tests?label=tests)
![Check & fix styling](https://github.com/spatie/laravel-robots-middleware/workflows/Check%20&%20fix%20styling/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-robots-middleware.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-robots-middleware)

A tiny, opinionated package to enable or disable indexing your site via a middleware in Laravel.

More on the Robots meta tag: https://developers.google.com/webmasters/control-crawl-index/docs/robots_meta_tag

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-robots-middleware.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-robots-middleware)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

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

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
