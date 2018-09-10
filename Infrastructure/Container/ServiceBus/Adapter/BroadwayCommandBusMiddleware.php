<?php

namespace Infrastructure\Container\ServiceBus\Adapter;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Infrastructure\Container\ServiceBus\CommandBus\CommandBusMiddlewareInterface;

class BroadwayCommandBusMiddleware implements CommandBusMiddlewareInterface
{
    private $bus;

    public function __construct(BroadwayCommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function handle(CommandInterface $command, callable $next)
    {
        $this->bus->dispatch($command);
        $next($command);
    }
}