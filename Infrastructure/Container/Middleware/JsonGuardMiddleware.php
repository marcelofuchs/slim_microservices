<?php

namespace Infrastructure\Container\Middleware;

use League\JsonGuard\Validator;
use Psr7Middlewares\Middleware;


class JsonGuardMiddleware extends Middleware
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route');
        $rName = $route ? $route->getName() : null;

        $validator = new Validator(
            $request->getQueryParam('q'),
            $this->app->getContainer()->get('schemas_path') . DIRECTORY_SEPARATOR . $rName
        );

        if ($validator->passes()) {
            return $next($request, $response);
        }

        return $response->withJson("opaaaa", 200)->withHeader('Content-type', 'application/json');
    }
}