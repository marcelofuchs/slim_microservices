<?php

declare(strict_types=1);

namespace Infrastructure\Container\ServiceBus\CommandBus;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Interface CommandBusMiddlewareInterface
 *
 * @package Infrastructure\Container\ServiceBus\CommandBus
 */
interface CommandBusMiddlewareInterface
{
    /**
     * @param CommandInterface $command
     * @param callable $next
     * @return mixed
     */
    public function handle(CommandInterface $command, callable $next);
}