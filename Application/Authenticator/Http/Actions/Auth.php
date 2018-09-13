<?php

namespace Application\Authenticator\Http\Actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

/**
 * Auth Controller
 * 
 * @package Application\Authenticator\Http\Controllers
 */
class Auth {

    /** @var object  */
    protected $container;

    /**
     * @inheritdoc
     */
    public function __construct($container) {
        $this->container = $container;
    }

    /**
     * Invoke class
     * 
     * @param Request $request
     * @param Response $response
     * @param type $args
     * @return type
     */
    public function __invoke(Request $request, Response $response, $args) {

        /**
         * JWT Key
         */
        $key = $this->container->get("secretkey");

        $token = array(
            "user" => "@fidelissauro",
            "twitter" => "https://twitter.com/fidelissauro",
            "github" => "https://github.com/msfidelis"
        );

        $jwt = JWT::encode($token, $key);

        return $response->withJson(["auth-jwt" => $jwt], 200)
                        ->withHeader('Content-type', 'application/json');
    }

}
