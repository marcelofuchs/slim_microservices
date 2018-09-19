<?php

namespace Application\Administracao\Http\Actions\Empresas;

use Domain\Abstractions\AbstractAction;
use Domain\Contracts\Services\EmpresasServiceInterface;
use Slim\Http\Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Action Create
 */
class EmpresaOne extends AbstractAction
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

        $booksService = $this->container->get(EmpresasServiceInterface::class);
        $book = $booksService->find($id);

        if($book){
            return $response->withJson($book, 200)->withHeader('Content-type', 'application/json');
        }

        return $response->withJson("", 404)->withHeader('Content-type', 'application/json');
    }
}
