<?php
declare(strict_types=1);

namespace Phauthentic\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareStackTestCase extends TestCase
{
    public function getServerRequestMock()
    {
        return $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
    }

    public function getMiddlewareMock()
    {
        return $this->getMockBuilder(MiddlewareInterface::class)
            ->getMock();
    }

    public function getResponseMock()
    {
        return $this->getMockBuilder(ResponseInterface::class)
            ->getMock();
    }
}
