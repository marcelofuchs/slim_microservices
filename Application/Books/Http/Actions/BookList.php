<?php

namespace Application\Books\Http\v1\Actions;

use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceInterface;
use \Domain\Abstractions\AbstractAction;
use Slim\Http\Request;

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
    public function process(Request $request, Response $response, $args = [])
    {
        $booksService = $this->container->get(BooksServiceInterface::class);
        $books = $booksService->findAll();

        return $response->withJson($books, 200)->withHeader('Content-type', 'application/json');
    }
}