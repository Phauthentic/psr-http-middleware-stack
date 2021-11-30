<?php

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStack;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareStackTest extends TestCase
{
    public function testMiddlewareStack()
    {
        $middlewareMock = $this->getMockBuilder(MiddlewareInterface::class)
            ->getMock();

        $middlewareStack = new MiddlewareStack();
        $middlewareStack->add($middlewareMock);

        $result = $middlewareStack->current();

        $this->assertEquals($middlewareMock, $result);
    }
}
