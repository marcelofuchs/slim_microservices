<?php

namespace Infrastructure\Container\ServiceBus\CommandBus;

//use MMLabs\Core\ServiceBus\Command\CommandInterface;
//use MMLabs\Core\ServiceBus\CommandBusInterface;

/**
 * Trait InjectCommandBusTrait
 * @package Infrastructure\Container\ServiceBus\CommandBus
 */
trait InjectCommandBusTrait
{
    /**
     * @var
     */
    protected $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function setCommandBus(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param CommandInterface $command
     */
    public function dispatchCommand(CommandInterface $command)
    {
        $this->commandBus->dispatch($command);
    }
}
