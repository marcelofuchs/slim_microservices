<?php

declare(strict_types=1);

namespace Infrastructure\Container\Domain;

use Broadway\EventSourcing\EventSourcedAggregateRoot;

abstract class AggregateRoot extends EventSourcedAggregateRoot
{
    protected function raise($event)
    {
        $this->apply($event);
    }
}