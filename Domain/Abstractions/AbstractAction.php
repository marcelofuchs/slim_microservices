<?php

namespace Domain\Abstractions;

use Infrastructure\Container\Factory\Actions\BaseActionInterface;
use Infrastructure\Container\ServiceBus\CommandBusInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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
    private $commandBus;

    /**
     * Class Constructor
     * @param ContainerInterface $container
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
    abstract public function __invoke(Request $request, Response $response, $args = []);
}