<?php

declare(strict_types=1);

namespace Infrastructure\Container\Command;

use Broadway\CommandHandling\SimpleCommandBus;
use Infrastructure\Container\EventBus\InjectEventBusTrait;
use Infrastructure\Container\Middleware\LogCommandsMiddleware;
//use Infrastructure\Container\Middleware\TransactionalMiddleware; // if transactional
use Infrastructure\Container\ServiceBus\Adapter\BroadwayCommandBus;
use Infrastructure\Container\ServiceBus\Adapter\BroadwayCommandBusMiddleware;
use Infrastructure\Container\ServiceBus\CommandBus\CommandBusSupportingMiddleware;
use Infrastructure\Container\ServiceBus\CommandBus\InjectCommandBusTrait;
use Infrastructure\Container\ServiceBus\EventBusInterface;
use Interop\Container\ContainerInterface;

final class CommandBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $handlers           = $container->get('config')['command_bus']['handlers'];
        $broadwayCommandBus = new BroadwayCommandBus(new SimpleCommandBus());
        $services           = [];

        foreach ($handlers as $handlerService) {
            array_push($services, $container->get($handlerService));
        }

        foreach ($services as $service) {
            $broadwayCommandBus->subscribe($service);
        }

        $commandBusMiddleware = new CommandBusSupportingMiddleware();
        $commandBusMiddleware->appendMiddleware(new LogCommandsMiddleware($container->get('logger')));
       /* $commandBusMiddleware->appendMiddleware(new TransactionalMiddleware(
            $container->get('doctrine.entity_manager.orm_default')
        ));*/
        $commandBusMiddleware->appendMiddleware(new BroadwayCommandBusMiddleware($broadwayCommandBus));

        // inject command bus
        foreach ($services as $service) {
            foreach (class_uses($service) as $trait) {
                if ($trait !== InjectCommandBusTrait::class) {
                    continue;
                }

                $service->setCommandBus($commandBusMiddleware);
            }
        }

        // inject event bus
        foreach ($services as $service) {
            foreach (class_uses($service) as $trait) {
                if ($trait !== InjectEventBusTrait::class) {
                    continue;
                }

                $service->setEventBus($container->get(EventBusInterface::NAME));
            }
        }

        return $commandBusMiddleware;
    }
}
