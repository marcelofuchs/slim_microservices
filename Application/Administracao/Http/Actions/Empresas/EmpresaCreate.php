<?php

namespace Application\Administracao\Http\Actions\Empresas;

use Application\Administracao\Contracts\Commands\Empresas\EmpresaCreateInterface;
use Domain\Abstractions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\Request;

/**
 * Action Create
 */
class EmpresaCreate extends AbstractAction
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
        $data = $request->getParsedBody() ?? [];

        /** @var EmpresaCreateInterface $command */
        $command = $this->container->get(EmpresaCreateInterface::class)::fromArray($data);
        $this->commandBus->dispatch($command);

        return $response->withJson($command->toArray(), 201);
    }
}
