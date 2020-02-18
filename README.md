# Lararvel Request Rules

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bachilli/laravel-request-rules.svg?style=flat-square)](https://packagist.org/packages/bachilli/laravel-request-rules)
[![Build Status](https://img.shields.io/travis/bachilli/laravel-request-rules/master.svg?style=flat-square)](https://travis-ci.org/bachilli/laravel-request-rules)
[![Quality Score](https://img.shields.io/scrutinizer/g/bachilli/laravel-request-rules.svg?style=flat-square)](https://scrutinizer-ci.com/g/bachilli/laravel-request-rules)
[![Total Downloads](https://img.shields.io/packagist/dt/bachilli/laravel-request-rules.svg?style=flat-square)](https://packagist.org/packages/bachilli/laravel-request-rules)

Stop duplicating code and validations for FormRequests. This package provides reuse of FormRequest components in a generic way!

## Installation

You can install the package via composer:

```bash
composer require bachilli/laravel-request-rules
```

## Usage

Create your main FormRequests with all your validation rules. After that, create unique FormRequests for your controller
methods. There is an example of a StoreProductRequest:

``` php
public function rules()
    {
        return RequestRule::resolveRules(
            [
            'name' => 'required',
            ],
            [
                RequestRule::merge(VolumeEntity::class, 'volumes.*', 'required|array')->only(['dimensions'])->get(),
                RequestRule::merge(ProductEntity::class, 'products.*')->except(['price'])->get(),
            ]);
    }
```

The first array on resolveRules method is exclusive for your FormRequest, the second array is the composed rules, imported
from other FormRequests.

## Methods

There some helper methods available to use when you're importing rules. Below the description of all methods.

### merge(FormRequest::class, 'desired_field_name', 'optional_validations")

In the `desired_field_name` you can pass with the suffix `.*` to specify an array field.

The `optional_validations` are useful when you need an array field and want some validation, like `required`.

### only(['field_name', FormRequestRule::class])

You can import only rules if you want.

### except(['field_name', FormRequestRule::class])

You can do the opposite, importing all rules, except the specified ones.

### Testing

Not implemented yet.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email bachilli@gmail.com instead of using the issue tracker.

## Credits

- [Bachilli](https://github.com/bachilli)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
