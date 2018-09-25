<?php

namespace Infrastructure\Container\Middleware;

use Slim\Http\Request;
use Opis\JsonSchema\{Validator, ValidationResult, ValidationError, Schema};

/**
 * Class JsonGuardMiddleware
 *
 * @package Infrastructure\Container\Middleware
 */
class JsonGuardMiddleware
{

    /**
     * @var
     */
    protected $app;

    /**
     * @var
     */
    protected $validatorResult = ['error' => null];

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
            $this->validatorResult['error'] = "Invalid Json: " . json_last_error_msg();
            return false;
        }

        $decodeShema = Schema::fromJsonString(file_get_contents($schema));
        if (!$decodeShema) {
            $this->validatorResult['error'] = "Invalid Shema Json: " . json_last_error_msg();
            return false;
        }

        $validator = new Validator();
        $result = $validator->schemaValidation($decode, $decodeShema);
        if ($result->isValid()) {
            return true;
        }

        /** @var ValidationError $error */
        $error = $result->getFirstError();

        $this->validatorResult['error'] = "Error: " . $error->keyword() . " " .
            json_encode($error->keywordArgs(), JSON_PRETTY_PRINT) .
            " Field " . implode(",", $error->dataPointer());

        return false;
    }
}