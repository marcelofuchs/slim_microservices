<?php

declare(strict_types=1);

namespace Infrastructure\Container\EventBus;

interface EventBusMiddlewareInterface
{
    public function handle(\Traversable $command, callable $next);
}