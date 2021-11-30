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

use Phauthentic\Infrastructure\Http\Middleware\CallableMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareStackFactory implements MiddlewareStackFactoryInterface
{
    /**
     * @var \Psr\Container\ContainerInterface;
     */
    protected ContainerInterface $container;

    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }

    /**
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface<int, \Psr\Http\Server\MiddlewareInterface>
     */
    public function createMiddlewareStack(): MiddlewareStackInterface
    {
        return new MiddlewareStack();
    }

    /**
     * @inheritDoc
     */
    public function createMiddlewareStackFromArray(array $middlewares): MiddlewareStackInterface
    {
        return $this->populateStackFromArray($this->createMiddlewareStack(), $middlewares);
    }

    /**
     * @param \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface<int, \Psr\Http\Server\MiddlewareInterface> $middlewareStack
     * @param array<int, \Psr\Http\Server\MiddlewareInterface|string|callable> $middlewares
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface<int, \Psr\Http\Server\MiddlewareInterface>
     */
    protected function populateStackFromArray(
        MiddlewareStackInterface $middlewareStack,
        array $middlewares
    ): MiddlewareStackInterface {
        foreach ($middlewares as $middleware) {
            if (is_string($middleware) && $this->container->has($middleware)) {
                $middleware = $this->container->get($middleware);
            }

            if ($middleware instanceof MiddlewareInterface) {
                $middlewareStack->add($middleware);
                continue;
            }

            if (is_callable($middleware)) {
                $middleware = new CallableMiddleware($middleware);
            }

            $middlewareStack->add($middleware);
        }

        return $middlewareStack;
    }
}
