<?php

namespace Domain\Abstractions;

use Infrastructure\Container\Factory\Actions\BaseActionInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

abstract class AbstractAction implements BaseActionInterface
{
    /**
     * Container Class
     *
     * @var [object]
     */
    protected $container;

    /**
     * Container Class
     *
     * @var [object]
     */
    protected $commandBus;

    /**
     * Class Constructor
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    abstract public function __invoke(Request $request, Response $response, $args = []);
}