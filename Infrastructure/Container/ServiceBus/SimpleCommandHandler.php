<?php

declare(strict_types=1);

namespace Infrastructure\Container\ServiceBus;

use Broadway\CommandHandling\CommandHandler;
use Infrastructure\Container\ServiceBus\Command\CommandHandlerInterface;

/**
 * Class SimpleCommandHandler
 *
 * @package Infrastructure\Container\ServiceBus
 */
abstract class SimpleCommandHandler implements CommandHandlerInterface, CommandHandler
{
    /**
     * {@inheritDoc}
     */
    public function handle($command)
    {
        $method = $this->getHandleMethod($command);

        if (! method_exists($this, $method)) {
            return;
        }

        $this->$method($command);
    }

    /**
     * @param $command
     * @return string
     */
    private function getHandleMethod($command)
    {
        if (! is_object($command)) {
            throw new \RuntimeException('Command not an object');
        }

        $classParts = explode('\\', get_class($command));

        return 'handle' . end($classParts);
    }
}