<?php

namespace Application\Books\Http\Actions;

use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceInterface;
use \Domain\Abstractions\AbstractAction;
use Slim\Http\Request;

/**
 * Action Create
 */
class BookDelete extends AbstractAction
{
    /**
     * Cria um novo cadastro de Livro
     *
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function process(Request $request, Response $response, $args = [])
    {
        $id = (int)$args['id'];

        $bookService = $this->container->get(BooksServiceInterface::class);
        $bookService->delete($id);

        $return = $response->withJson("", 202)->withHeader('Content-type', 'application/json');

        return $return;
    }
}