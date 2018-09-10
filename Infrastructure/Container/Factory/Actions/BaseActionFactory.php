<?php

namespace Infrastructure\Container\Factory\Actions;

use Assert\Assertion;
use Infrastructure\Container\ServiceBus\CommandBusInterface;
use Psr\Container\ContainerInterface;

class BaseActionFactory
{
    public function __invoke($container, $requestedService)
    {
        echo "sdfsd";exit;
        Assertion::classExists($requestedService);
        print_r('sd');exit;

        return new $requestedService($container->get(CommandBusInterface::NAME));
    }
}
