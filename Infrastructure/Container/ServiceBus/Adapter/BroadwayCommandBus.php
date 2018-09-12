<?php

namespace Infrastructure\Container\ServiceBus\Adapter;

use Broadway\CommandHandling\CommandBus;
use Infrastructure\Container\ServiceBus\Command\CommandHandlerInterface;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Infrastructure\Container\ServiceBus\CommandBusInterface;

class BroadwayCommandBus implements CommandBusInterface
{
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * Registra os commandHandlers que poderão tratar o command
     *
     * @param CommandHandlerInterface $commandHandler
     */
    public function subscribe(CommandHandlerInterface $commandHandler)
    {
        $this->bus->subscribe($commandHandler);
    }

    /**
     * Dispara para um commandHandler poder tratar
     *
     * @param CommandInterface $command
     */
    public function dispatch(CommandInterface $command)
    {
        $this->bus->dispatch($command);
    }
}