<?php

namespace Infrastructure\Container\EventBus;

use Infrastructure\Container\ServiceBus\EventBusInterface;

trait InjectEventBusTrait
{
    /** @var EventBusInterface */
    protected $eventBus;

    public function setEventBus(EventBusInterface $commandBus)
    {
        $this->eventBus = $commandBus;
    }

    public function publish(\IteratorAggregate $events)
    {
        $this->eventBus->publish($events);
    }
}
