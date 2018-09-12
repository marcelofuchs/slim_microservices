<?php

namespace Application\Books\Http\v1\Actions;

use Infrastructure\Container\ServiceBus\CommandBusInterface;
use Interop\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceInterface;
use \Domain\Abstractions\AbstractAction;

/**
 * Action List
 */
class BookList extends AbstractAction
{
    /**
     * Listagem de Livros
     *
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args = [])
    {
        print_r('sdfsdfsdf ff');exit;
        $books = $this->service->findAll();
        return $response->withJson($books, 200)->withHeader('Content-type', 'application/json');
    }
}