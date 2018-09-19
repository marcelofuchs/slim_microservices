<?php

namespace Application\Administracao\Http\Actions\Empresas;

use Application\Administracao\Contracts\Commands\Empresas\EmpresaUpdateInterface;
use Domain\Abstractions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\Request;

class EmpresaUpdate extends AbstractAction
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
        $data = json_decode($request->getBody()->getContents(), true);
        $data['id'] = (int) $args['id'];

        /** @var BookUpdateInterface $command */
        $command = $this->container->get(EmpresaUpdateInterface::class)::fromArray($data);
        $this->commandBus->dispatch($command);

        return $response->withJson($command->toArray(), 201);
    }
}