<?php

declare(strict_types=1);

namespace Infrastructure\Container\ServiceBus;

interface EventBusInterface
{
    const NAME = 'eventBus';

    public function publish(\IteratorAggregate $event);
}