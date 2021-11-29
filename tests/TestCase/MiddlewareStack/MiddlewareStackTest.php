<?php

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStack;
use PHPUnit\Framework\TestCase;

class MiddlewareStackTest extends TestCase
{
    public function middlewareStacktest()
    {
        $middleware = new MiddlewareStack();
    }
}
