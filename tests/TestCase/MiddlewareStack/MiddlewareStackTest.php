<?php

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\OutOfBoundsException;
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStack;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareStackTest extends TestCase
{
    /**
     * @throws \Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\OutOfBoundsException
     */
    public function testMiddlewareStack(): void
    {
        $middlewareMock = $this->getMockBuilder(MiddlewareInterface::class)
            ->getMock();

        $middlewareStack = new MiddlewareStack();
        $middlewareStack->add($middlewareMock);

        $result = $middlewareStack->current();

        $this->assertEquals($middlewareMock, $result);
        $this->assertEquals(0, $middlewareStack->key());
        $this->assertTrue($middlewareStack->valid());

        $middlewareStack->next();
        $this->assertFalse($middlewareStack->valid());
    }

    /**
     * @throws \Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\OutOfBoundsException
     */
    public function testInvalid(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $middlewareStack = new MiddlewareStack();
        $middlewareStack->current();
    }

    /**
     * @throws \Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\OutOfBoundsException
     */
    public function testInvalidSeek(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $middlewareStack = new MiddlewareStack();
        $middlewareStack->seek(999);
    }
}
