# Using the Middleware Stack

This library implements the [PSR-15](https://www.php-fig.org/psr/psr-15/) handler, and a stack that will process the middlewares also defined by PSR-15.

Using the stack should be straight forward, the concept is pretty easy. You have the PSR middleware handler and the stack. The handler takes the stack filled with middlwares and walks  through them until a PSR response is being returned. See the two examples:

## Manual setup

The `MiddlewareStack` will take only instances of the PSR middleware interface.

```php
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStack;
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackHandler;

$middlewareStack = new MiddlewareStack();
$middlewareStack->add(new SomeMiddleware());
$middlewareStack->add(new SomeOtherMiddleware());

$handler = new MiddlewareStackHandler($middlewareStack);
$handler->handle($psrServerRequest);
```

## Using the provided Factory

The factory is most useful when you want to get the middleware stack from a container or configuration array.

The factory takes an array of strings, callables or middleware objects, that are internally processed and added to the stack. The strings are being used to get the middlewares by that string from the PSR container.

```php
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackFactory;
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackHandler;

$middlewareStackFactory = new MiddlewareStackFactory($psrContainer);

$middlewareStack = $middlewareStackFactory->createMiddlewareStackFromArray([
    SomeMiddleware::class,
    new SomeOtherMiddleware(),
    function() {
        // ...
    }
]);

$handler = new MiddlewareStackHandler($middlewareStack);
$handler->handle($psrServerRequest);
```
