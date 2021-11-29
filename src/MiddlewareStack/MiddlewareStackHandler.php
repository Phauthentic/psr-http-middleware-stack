<?php

/**
 * Copyright (c) Florian Krämer (https://florian-kraemer.net)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * @author    Florian Krämer
 * @link      https://github.com/Phauthentic
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Http\MiddlewareStack;

use Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\MiddlewareStackException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareStackHandler implements RequestHandlerInterface
{
    /**
     * @var \Phauthentic\Infrastructure\Http\MiddlewareSTack\MiddlewareStackInterface
     */
    protected MiddlewareStackInterface $middlewareStack;

    /**
     * @param \Phauthentic\Infrastructure\Http\MiddlewareSTack\MiddlewareStackInterface
     */
    public function __construct(MiddlewareStackInterface $middlewares)
    {
        $this->middlewareStack = $middlewares;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->middlewareStack->valid()) {
            $middleware = $this->middlewareStack->current();
            $this->middlewareStack->next();

            return $middleware->process($request, $this);
        }

        throw new MiddlewareStackException('No middleware was executed');
    }
}
