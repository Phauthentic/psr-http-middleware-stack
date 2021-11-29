<?php
declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\Middleware\CallableMiddleware;
use PHPUnit\Framework\TestCase;

class CallableMiddlewareTest extends TestCase
{
    public function middlewareStacktest()
    {
        $callable = function() {

        };

        $middleware = new CallableMiddleware($callable);
        $middleware->process();
    }
}
