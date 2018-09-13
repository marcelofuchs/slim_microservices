<?php

namespace Application\Books\Http\v1\Actions;

use Domain\Abstractions\AbstractAction;
use Slim\Http\Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Action Create
 */
class BookOne extends AbstractAction
{
    /**
     * Invoke
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function process(Request $request, Response $response, $args = [])
    {
        $id = (int) $args['id'];
        $book = $this->service->find($id);
        return $response->withJson($book, 200)->withHeader('Content-type', 'application/json');
    }
}
