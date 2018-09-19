<?php

namespace Infrastructure\Container\Middleware;

use League\JsonGuard\Validator;
use Psr7Middlewares\Middleware;
use Slim\Http\Request;

/**
 * Class JsonGuardMiddleware
 *
 * @package Infrastructure\Container\Middleware
 */
class JsonGuardMiddleware extends Middleware
{

    /**
     * @var
     */
    protected $app;

    /**
     * @var
     */
    protected $validatorResult;

    /**
     * JsonGuardMiddleware constructor.
     * @param $app
     */
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

        if (
            $this->validJson($this->getQueryString($request), $route, 'q')
            && $this->validJson($this->getBodyContent($request), $route)
        ) {
            return $next($request, $response);
        }

        return $response->withJson($this->validatorResult, 400)->withHeader('Content-type', 'application/json');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getQueryString(Request $request)
    {
        return $request->getQueryParam('q', '{}');
    }

    /**
     * @param Request $request
     * @return false|string
     */
    protected function getBodyContent(Request $request)
    {
        return json_encode($request->getParsedBody() ?? []);
    }

    /**
     * @param string $json
     * @param $routeName
     * @param string $alias - alias for many files.
     * @return bool
     */
    protected function validJson(string $json, $routeName, $alias = null)
    {
        $errors = [];
        $rName = $routeName ? $routeName->getName() . ($alias ? ".$alias" : '') . ".json" : null;
        $schema = $this->app->getContainer()->get('schemas_path') . DIRECTORY_SEPARATOR . $rName;

        if (!file_exists($schema)) {
            return true;
        }

        $decode = json_decode($json, false);
        if (!$decode) {
            $this->validatorResult[] = "Invalid Json: " . json_last_error_msg();
            return false;
        }

        $decodeShema = json_decode(file_get_contents($schema), false);
        if (!$decodeShema) {
            $this->validatorResult[] = "Invalid Shema Json: " . json_last_error_msg();
            return false;
        }

        $validator = new Validator($decode, $decodeShema);
        if ($validator->passes()) {
            return true;
        }

        foreach ($validator->errors() as $error) {
            $errors[] = "The field: " . $error->getDataPath() . " has an error with message: " . $error->getMessage();
        }
        $this->validatorResult = $errors;
        return false;
    }
}