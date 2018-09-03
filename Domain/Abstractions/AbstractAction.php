<?php

namespace Domain\Abstractions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

abstract class AbstractAction
{
    /**
     * Container Class
     * 
     * @var [object]
     */
    protected $container;

    /**
     * Class Constructor
     * @param \Domain\Abstractions\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    /**
     * @inheritdoc
     */
    abstract public function __invoke(Request $request, Response $response, $args = []);
}