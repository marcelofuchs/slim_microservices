<?php

namespace Infrastructure\Container\EventBus;

//use MMLabs\Core\ServiceBus\EventBusInterface;

class EventBusSupportingMiddleware implements EventBusInterface
{
    /**
     * @var EventBusMiddlewareInterface[]
     */
    private $middlewares = [];
    
    public function __construct(array $middlewares = []) {
        foreach ($middlewares as $middleware) {
            $this->appendMiddleware($middleware);
        }
    }

    public function appendMiddleware(EventBusMiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function publish(\IteratorAggregate $message)
    {
        call_user_func($this->callableForNextMiddleware(0), $message);
    }

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