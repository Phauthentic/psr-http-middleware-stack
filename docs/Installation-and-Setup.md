# Installation and Setup

## Installation

Install it via [Composer](https://getcomposer.org/)

```sh
composer require phauthentic/psr-http-middleware-stack
```

If you want to manually install it we assume you know what you're doing by not using Composer.

## Development Tools

We are using [Phive](https://github.com/phar-io/phive) for most of the dev tools. This provides a few advantges, mostly that we get away with a lot less dev dependencies that can cause additional conflicts.

The dev tools should be alread installed through the post-install callback of Composer.

To manually install Phive and the dev tools you can run:

```sh
composer phive
```

It will download Phive and execute it to install phar versions of these dev tools into the `/bin` folder of the repository.

 * [phpunit](https://phpunit.de/)
 * [phpcs](https://github.com/squizlabs/PHP_CodeSniffer/)
 * [phpcbf](https://github.com/squizlabs/PHP_CodeSniffer/)
 * [phpstan](https://phpstan.org/)
 * [grumphp](https://github.com/phpro/grumphp)
