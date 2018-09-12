<?php

namespace Infrastructure\Container\ServiceBus\CommandBus;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Infrastructure\Container\ServiceBus\CommandBusInterface;

/**
 * Class CommandBusSupportingMiddleware
 * @package Infrastructure\Container\ServiceBus\CommandBus
 */
class CommandBusSupportingMiddleware implements CommandBusInterface
{
    /**
     * @var CommandBusMiddlewareInterface[]
     */
    private $middlewares = [];

    /**
     * CommandBusSupportingMiddleware constructor.
     * @param array $middlewares
     */
    public function __construct(array $middlewares = [])
    {
        foreach ($middlewares as $middleware) {
            $this->appendMiddleware($middleware);
        }
    }

    /**
     * @param CommandBusMiddlewareInterface $middleware
     */
    public function appendMiddleware(CommandBusMiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @param CommandBusMiddlewareInterface $middleware
     */
    public function removeMiddleware(CommandBusMiddlewareInterface $middleware)
    {
        foreach ($this->middlewares as $key => $_middleware) {
            if (get_class($_middleware) !== get_class($middleware)) {
                continue;
            }

            unset($this->middlewares[$key]);
        }
    }

    /**
     * @return CommandBusMiddlewareInterface[]
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * @param CommandInterface $message
     */
    public function dispatch(CommandInterface $message)
    {
        call_user_func($this->callableForNextMiddleware(0), $message);
    }

    /**
     * @param $index
     * @return \Closure
     */
    private function callableForNextMiddleware($index)
    {
        if (!isset($this->middlewares[$index])) {
            return function () {
            };
        }

        $middleware = $this->middlewares[$index];
        return function ($message) use ($middleware, $index) {
            $middleware->handle($message, $this->callableForNextMiddleware($index + 1));
        };
    }
}