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

use Phauthentic\Infrastructure\Http\MiddlewareStack\Exception\OutOfBoundsException;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareStack implements MiddlewareStackInterface
{
    /**
     * @var array
     */
    protected array $stack = [];

    /**
     * @var int
     */
    protected int $position = 0;

    /**
     * @param \Psr\Http\Server\MiddlewareInterface $middleware Middleware
     * @return void
     */
    public function add(MiddlewareInterface $middleware): void
    {
        $this->stack[] = $middleware;
    }

    /**
     * Return the current element
     *
     * @link https://php.net/manual/en/iterator.current.php
     * @return \Psr\Http\Server\MiddlewareInterface
     */
    public function current(): MiddlewareInterface
    {
        if (!isset($this->stack[$this->position])) {
            throw new OutOfBoundsException(
                'Invalid position: ' . $this->position
            );
        }

        return $this->stack[$this->position];
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->stack[$this->position]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @param int $position <p>
     * @return void
     */
    public function seek($position): void
    {
        if (!isset($this->stack[$position])) {
            throw new OutOfBoundsException(
                'Invalid seek position: ' . $position
            );
        }

        $this->position = $position;
    }
}
