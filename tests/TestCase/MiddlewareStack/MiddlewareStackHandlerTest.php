<?php

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\MiddlewareStackException;
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStack;
use Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareStackHandlerTest extends TestCase
{
    public function testNoMiddlewareFound(): void
    {
        $serverRequestMock = $this->getServerRequestMock();
        $middlewareStack = new MiddlewareStack();

        $this->expectException(MiddlewareStackException::class);
        $this->expectExceptionMessage('No middleware was executed');

        $middlewareStackHandler = new MiddlewareStackHandler($middlewareStack);
        $middlewareStackHandler->handle($serverRequestMock);
    }

    public function testMiddlewareFound(): void
    {
        $responseMock = $this->getResponseMock();
        $middlewareMock = $this->getMiddlewareMock();
        $middlewareMock
            ->method('process')
            ->willReturn($responseMock);

        $serverRequestMock = $this->getServerRequestMock();
        $middlewareStack = new MiddlewareStack();
        $middlewareStack->add($middlewareMock);

        $middlewareStackHandler = new MiddlewareStackHandler($middlewareStack);
        $result = $middlewareStackHandler->handle($serverRequestMock);

        $this->assertEquals($responseMock, $result);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\ServerRequestInterface
     */
    public function getServerRequestMock()
    {
        return $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Server\MiddlewareInterface
     */
    public function getMiddlewareMock()
    {
        return $this->getMockBuilder(MiddlewareInterface::class)
            ->getMock();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\ResponseInterface
     */
    public function getResponseMock()
    {
        return $this->getMockBuilder(ResponseInterface::class)
            ->getMock();
    }
}
