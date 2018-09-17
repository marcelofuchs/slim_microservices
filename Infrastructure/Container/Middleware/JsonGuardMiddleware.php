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
        $errors = [];
        $route = $request->getAttribute('route');
        $rName = $route ? $route->getName() . ".json" : null;
        $schema = $this->app->getContainer()->get('schemas_path') . DIRECTORY_SEPARATOR . $rName;

        if (file_exists($schema)) {
            $validator = new Validator(json_decode($request->getQueryParam('q')),
                                        json_decode(file_get_contents($schema)));

            foreach ($validator->errors() as $error) {
                $errors[] = $error->getMessage();
            }

            return ($validator->passes()) ? $next($request, $response)
                : $response->withJson($errors, 400)->withHeader('Content-type', 'application/json');
        }

        return $next($request, $response);
    }
}