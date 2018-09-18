<?php

namespace Infrastructure\Container\Middleware;

use League\JsonGuard\Validator;
use Psr7Middlewares\Middleware;
use Slim\Http\Request;


class JsonGuardMiddleware extends Middleware
{

    protected $app;
    protected $validatorResult;

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
    public function __invoke(Request $request, $response, $next)
    {
        $route = $request->getAttribute('route');

        $dataQ = function($request) { return $request->getQueryParam('q'); };
        $dataB = function($request) { return $request->getBody()->getContents(); };

        if($this->validJson($dataQ, $route) && $this->validJson($dataB, $route)){
            return $next($request, $response);
        }

        return $response->withJson($this->validatorResult, 400)->withHeader('Content-type', 'application/json');
    }

    protected function validJson($json, $routeName){
        $errors = [];
        $rName = $routeName ? $routeName->getName() . ".json" : null;
        $schema = $this->app->getContainer()->get('schemas_path') . DIRECTORY_SEPARATOR . $rName;

        if (!file_exists($schema)) {
            return true;
        }

        $validator = new Validator(json_decode($json, true), json_decode(file_get_contents($schema), true));

        if($validator->passes()){
            return true;
        }

        foreach ($validator->errors() as $error) {
            $errors[] = $error->getMessage();
        }

        $this->validatorResult = $errors;

        return false;
    }
}