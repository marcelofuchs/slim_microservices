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

    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route');
        $rName = $route ? $route->getName() . ".json" : null;

        $validator = new Validator(
            json_decode($request->getQueryParam('q')),
            json_decode(file_get_contents(
                $this->app->getContainer()->get('schemas_path') .
                DIRECTORY_SEPARATOR . $rName))
        );

        return ($validator->passes()) ? $next($request, $response)
            : $response->withJson($validator->errors(), 200)->withHeader('Content-type', 'application/json');
    }
}