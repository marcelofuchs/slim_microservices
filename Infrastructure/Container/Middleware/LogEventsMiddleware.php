<?php

namespace Infrastructure\Container\Middleware;

use Infrastructure\Container\Domain\DomainEvent;
use Infrastructure\Container\Event\EventInterface;
use Infrastructure\Container\EventBus\EventBusMiddlewareInterface;
use Psr\Log\LoggerInterface;
//use MMLabs\Core\Domain\DomainEvent;
//use MMLabs\Core\ServiceBus\EventBus\EventBusMiddlewareInterface;
//use MMLabs\Core\ServiceBus\Event\EventInterface;

class LogEventsMiddleware implements EventBusMiddlewareInterface
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(\Traversable $events, callable $next)
    {
        foreach ($events as $event) {
            /** @var DomainEvent $domainEvent */
            $domainEvent = $event->getPayload();
            $message = [
                'event_class' => get_class($domainEvent),
                'event_name' => $this->getEventName($domainEvent),
                'aggregate_id' => $domainEvent->aggregateId(),
                'payload' => $domainEvent->serialize(),
                'recorded_at' => $domainEvent->recordedAt()->format('c')
            ];
            $this->logger->info('Event was published', $message);
        }

        $next($events);
    }

    private function getEventName(EventInterface $command)
    {
        $className = explode('\\', get_class($command));
        $className = end($className);
        $splitedName = preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY);
        return join(' ', $splitedName);
    }
}