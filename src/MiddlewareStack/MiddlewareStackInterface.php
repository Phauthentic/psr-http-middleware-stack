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

use Psr\Http\Server\MiddlewareInterface;
use SeekableIterator;

/**
 * Interface MiddlewareStackInterface
 *
 * @package Phauthentic\Infrastructure\Http\Middleware
 */
interface MiddlewareStackInterface extends SeekableIterator
{
    /**
     * Adds a middleware to the stack
     *
     * @param \Psr\Http\Server\MiddlewareInterface $middleware
     */
    public function add(MiddlewareInterface $middleware);
}
