<?php

namespace Infrastructure\Container\Factory\Actions;

use Assert\Assertion;
use Infrastructure\Container\ServiceBus\CommandBusInterface;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class BaseActionFactory
 *
 * @package Infrastructure\Container\Factory\Actions
 */
class BaseActionFactory
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $action;

    /**
     * BaseActionFactory constructor.
     *
     * @param ContainerInterface $container
     * @param string $action
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(Containerinterface $container, $action)
    {
        Assertion::classExists($action);

        $this->container = $container;
        $this->action = $action;
    }

    /**
     * @param $request
     * @param $requestedService
     * @return mixed
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request, Response $response, $args = [])
    {
        $action = new $this->action($this->container, $this->container->get(CommandBusInterface::class));
        return $action->process($request, $response, $args);
    }
}
