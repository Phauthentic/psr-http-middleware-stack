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

interface MiddlewareStackFactoryInterface
{
    /**
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface<int, \Psr\Http\Server\MiddlewareInterface>
     */
    public function createMiddlewareStack(): MiddlewareStackInterface;

    /**
     * @param array<int, mixed> $middlewares
     *
     * @return \Phauthentic\Infrastructure\Http\MiddlewareStack\MiddlewareStackInterface<int, \Psr\Http\Server\MiddlewareInterface>
     */
    public function createMiddlewareStackFromArray(array $middlewares): MiddlewareStackInterface;
}
