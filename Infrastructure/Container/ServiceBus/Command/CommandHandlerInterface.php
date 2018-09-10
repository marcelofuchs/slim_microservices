<?php

declare(strict_types=1);

namespace Infrastructure\Container\ServiceBus\Command;

/**
 * Interface CommandHandlerInterface
 *
 * @package Infrastructure\Container\ServiceBus\Command
 */
interface CommandHandlerInterface
{
    /**
     * @param mixed $command
     * @return mixed
     */
    public function handle($command);
}
