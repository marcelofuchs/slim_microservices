<?php
namespace Infrastructure\Container\Middleware;

use League\JsonGuard\Validator;
use Psr7Middlewares\Middleware;


class JsonGuardMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $validator = new Validator();
    }

}