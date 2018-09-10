<?php

declare(strict_types=1);

namespace Infrastructure\Container\ServiceBus;

//use MMLabs\Core\ServiceBus\Command\CommandInterface;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Interface CommandBusInterface
 *
 * @package MMLabs\Core\ServiceBus
 */
interface CommandBusInterface
{
    const NAME = 'commandBus';

    public function dispatch(CommandInterface $command);
}