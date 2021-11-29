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
     * @var mixed[]
     */
    protected array $middlewares;

    /**
     * @param \Psr\Container\ContainerInterface $container
     * @param array $middlewares
     */
    public function __construct(
        ContainerInterface $container,
        array $middlewares = []
    ) {
        $this->container = $container;
        $this->middlewares = $middlewares;
    }

    /**
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface
     */
    protected function createStack(): MiddlewareStackInterface
    {
        return new MiddlewareStack();
    }

    /**
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface
     */
    public function create(): MiddlewareStackInterface
    {
        $stack = $this->createStack();

        return $this->populateStackFromArray($stack);
    }

    /**
     * @param \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface $middlewareStack
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface
     */
    protected function populateStackFromArray(
        MiddlewareStackInterface $middlewareStack
    ): MiddlewareStackInterface {
        foreach ($this->middlewares as $middleware) {
            if (is_string($middleware) && !$this->container->has($middleware)) {
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
