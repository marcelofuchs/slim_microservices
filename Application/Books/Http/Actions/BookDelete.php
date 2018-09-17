<?php

namespace Application\Books\Http\Actions;

use Application\Books\Contracts\Commands\BookDeleteInterface;
use \Psr\Http\Message\ResponseInterface as Response;
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
        $id['id'] = (int)$args['id'];

        /** @var BookDeleteInterface $command */
        $command = $this->container->get(BookDeleteInterface::class)::fromArray($id);
        $this->commandBus->dispatch($command);

        return $response->withJson("Livro Deletado", 200);
    }
}