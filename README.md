## Laravel Stripe Package

Small scale Stripe gateway payment integration


### Installation

You can install the package via composer from you project root in two ways:

- Local Dependency
    - Create Composer Local Dependency Source
      ```bash
          mkdir "libraries"
      ```
    - Clone repo
      ```bash
          git clone https://github.com/ssiva13/laravel-stripe.git libraries/laravel-stripe
      ```
    - Add Composer Local Dependency Source to the repositories key
      ```bash
      "repositories": {
          "local": {
              "type": "path",
              "url": "./libraries/*",
              "options": {
                  "symlink": false
              }
          }
      },
      ```
      ```bash
        composer require ssiva/laravel-stripe:dev-main
      ```
- Git Source
    - Add Composer Git or VCS Source to the repositories key
      ```bash
      "repositories": {
          "local": {
              "type": "git",
              "url": "https://github.com/ssiva13/laravel-stripe.git",
              "options": {
                  "symlink": false
              }
          }
      },
      ```
      ```bash
        composer require ssiva/laravel-stripe:dev-main
      ```

### Configuration

- Open your `config/app.php` and add the following to the `providers` array:

```php
// LaravelStripe ServiceProvider
Ssiva\LaravelStripe\StripePayServiceProvider::class,
```

To use the package, you will need to set the following in your `.env` 

```dotenv
STRIPE_API_KEY=
STRIPE_API_SECRET=
STRIPE_SUCCESS_URL=
STRIPE_FAIL_URL=
STRIPE_REDIRECT_URL="payment.order" // use laravel route name
```

### Testing

You can run the package tests using PHPUnit. The tests are located in the **`tests`** directory.
In you Laravel project open `phpunit.xml` and add the following `testsuite` object in the `testsuites` body

```xml
<testsuite name="Laravel Stripe">
    <directory suffix="Test.php">./vendor/ssiva/laravel-stripe/Tests</directory>
</testsuite>
```
To test run either of the following
- `vendor/bin/phpunit`

- `php artisan test`

### Credits
[Simon Siva](https://ssiva13.github.io/)


### License
This package is open-sourced software licensed under the MIT license.