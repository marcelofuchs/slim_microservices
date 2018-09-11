<?php

namespace Infrastructure\Container\Factory\Actions;

use Assert\Assertion;
use Domain\Abstractions\AbstractAction;
use Infrastructure\Container\ServiceBus\CommandBusInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

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
    public function __invoke(ServerRequestInterface $request, $requestedService)
    {

      //  print_r($request);
       // exit;
        //Assertion::classExists($requestedService);

        return new $this->action($this->container->get(CommandBusInterface::NAME));
    }
}
