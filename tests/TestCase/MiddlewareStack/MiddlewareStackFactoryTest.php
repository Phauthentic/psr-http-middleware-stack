<?php

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class MiddlewareStackFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateMiddlewareStack(): void
    {
        $middlewareStackFactory = new MiddlewareStackFactory($this->getContainerMock());

        $middlewareStack = $middlewareStackFactory->createMiddlewareStack();

        // Check that it is empty
        $this->assertFalse($middlewareStack->valid());
    }

    /**
     * @return void
     */
    public function testCreateMiddlewareStackFromArray(): void
    {
        $middlewareStackFactory = new MiddlewareStackFactory($this->getContainerMock());

        $middlewareStack = $middlewareStackFactory->createMiddlewareStackFromArray([
            function () {
            },
            function () {
            },
        ]);

        $this->assertTrue($middlewareStack->valid());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Psr\Container\ContainerInterface
     */
    public function getContainerMock()
    {
        return $this->getMockBuilder(ContainerInterface::class)
            ->getMock();
    }
}
