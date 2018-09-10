<?php

require __DIR__.'/../vendor/autoload.php';

use Psr7Middlewares\Middleware\TrailingSlash;
use Monolog\Logger;
use Firebase\JWT\JWT;
use Slim\Container;
use Dotenv\Dotenv;

/**
 * Load environment
 */
//FROM DEFAULT
$baseEnv = new Dotenv(__DIR__.'/../');
$baseEnv->load();

/**
 * Container Resources do Slim.
 * Aqui dentro dele vamos carregar todas as dependências
 * da nossa aplicação que vão ser consumidas durante a execução
 * da nossa API
 */
$container = new Container(require_once __DIR__.'/../config/settings.global.php');

//Injections
require_once (__DIR__ . '/../Domain/Contracts/dependencies.php') ;

// DATABASE DEFAULT PRELOAD
$container['em'] = function (Container $container) {
    $manager = $container->get(\Domain\Contracts\Persistence\EntityManagerInterface::class);
    return $manager::create( $container['settings']['mm_crm'] );
};

/**
 * Converte os Exceptions Genéricas dentro da Aplicação em respostas JSON
 */
$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        $statusCode = $exception->getCode() ? $exception->getCode() : 500;
        return $container['response']->withStatus($statusCode)
            ->withHeader('Content-Type', 'Application/json')
            ->withJson(["message" => $exception->getMessage()], $statusCode);
    };
};

/**
 * Converte os Exceptions de Erros 405 - Not Allowed
 */
$container['notAllowedHandler'] = function ($container) {
    return function ($request, $response, $methods) use ($container) {
        return $container['response']
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-Type', 'Application/json')
            ->withHeader("Access-Control-Allow-Methods", implode(",", $methods))
            ->withJson(["message" => "Method not Allowed; Method must be one of: " . implode(', ', $methods)], 405);
    };
};

/**
 * Converte os Exceptions de Erros 404 - Not Found
 */
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'Application/json')
            ->withJson(['message' => 'Page not found']);
    };
};

/**
 * Serviço de Logging em Arquivo
 */
$container['logger'] = function($container) {
    $logger = new Monolog\Logger('bin-microservice');
    $logfile = __DIR__ . '/log/bin-microservice.log';
    $stream = new Monolog\Handler\StreamHandler($logfile, Monolog\Logger::DEBUG);
    $fingersCrossed = new Monolog\Handler\FingersCrossedHandler(
        $stream, Monolog\Logger::INFO);
    $logger->pushHandler($fingersCrossed);
    
    return $logger;
};

return $container;