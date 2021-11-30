<?php

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\MiddlewareStack;

use Phauthentic\Infrastructure\Http\Middleware\CallableMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CallableMiddlewareTest extends TestCase
{
    public function testCallableMiddleware(): void
    {
        $requestMock = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
        $requestHandlerMock = $this->getMockBuilder(RequestHandlerInterface::class)
            ->getMock();

        $responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $callable = function () use ($responseMock) {
            return $responseMock;
        };

        $middleware = new CallableMiddleware($callable);
        $result = $middleware->process($requestMock, $requestHandlerMock);

        $this->assertEquals($responseMock, $result);
    }
}
