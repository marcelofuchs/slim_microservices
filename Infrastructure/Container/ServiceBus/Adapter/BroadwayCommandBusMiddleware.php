<?php

namespace Infrastructure\Container\ServiceBus\Adapter;

use MMLabs\Core\ServiceBus\Command\CommandInterface;
use MMLabs\Core\ServiceBus\CommandBus\CommandBusMiddlewareInterface;

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