<?php

namespace Infrastructure\Container\Middleware;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Infrastructure\Container\ServiceBus\CommandBus\CommandBusMiddlewareInterface;

//use MMLabs\Core\ServiceBus\Command\CommandInterface;
//use MMLabs\Core\ServiceBus\CommandBus\CommandBusMiddlewareInterface;

class TransactionalMiddleware implements CommandBusMiddlewareInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(CommandInterface $command, callable $next)
    {
        if (!$this->entityManager->isOpen()) {
            // if the entity manager is closed in a previous command, reset the entity manager
            $this->entityManager = EntityManager::create(
                $this->entityManager->getConnection(),
                $this->entityManager->getConfiguration()
            );
        }

        $this->entityManager->beginTransaction();

        try {
            $next($command);
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Throwable $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}
