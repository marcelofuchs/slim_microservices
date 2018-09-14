<?php

namespace Domain\Abstractions;

use Infrastructure\Container\Factory\Actions\BaseActionInterface;
use Infrastructure\Container\ServiceBus\CommandBusInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\Request;

abstract class AbstractAction implements BaseActionInterface
{
    /**
     * Container Class
     *
     * @var [object]
     */
    protected $container;

    /**
     * @var CommandBusInterface
     */
    protected $commandBus;

    /**
     * Class Constructor
     *
     * @param ContainerInterface $container
     * @param CommandBusInterface $commandBus
     */
    public function __construct(
        ContainerInterface $container,
        CommandBusInterface $commandBus
    )
    {
        $this->container = $container;
        $this->commandBus = $commandBus;
    }

    /**
     * @inheritdoc
     */
    abstract public function process(Request $request, Response $response, $args = []);
}