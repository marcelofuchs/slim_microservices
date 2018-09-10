<?php

namespace Infrastructure\Container\Middleware;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Infrastructure\Container\ServiceBus\CommandBus\CommandBusMiddlewareInterface;
use Psr\Log\LoggerInterface;
//use MMLabs\Core\ServiceBus\CommandBus\CommandBusMiddlewareInterface;
//use MMLabs\Core\ServiceBus\Command\CommandInterface;

class LogCommandsMiddleware implements CommandBusMiddlewareInterface
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CommandInterface $command, callable $next)
    {
        $message = [
            'command_class' => get_class($command),
            'command_name' => $this->getCommandName($command),
            'command_params' => $command->toArray()
        ];

        try {
            $this->logger->info('Start handling a Command', $message);
            $next($command);
            $this->logger->info('Finish handling a Command', $message);
        } catch (\Throwable $e) {
            $context = $message + [
                'error' => $e->getMessage(),
                'exception_class' => get_class($e),
                'trace' => $e->getTraceAsString()
            ];

            $this->logger->error('An error occurred while trying to handling a command', $context);

            throw $e;
        }
    }

    private function getCommandName(CommandInterface $command)
    {
        $className = explode('\\', get_class($command));
        $className = end($className);
        $splitedName = preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY);
        return join(' ', $splitedName);
    }
}