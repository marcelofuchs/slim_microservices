<?php

namespace Application\Administracao\Http\Actions\Empresas;

use Domain\Contracts\Services\EmpresasServiceInterface;
use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Abstractions\AbstractAction;
use Slim\Http\Request;

/**
 * Action List
 */
class EmpresaList extends AbstractAction
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
        $queryString = json_decode($request->getQueryParam('q'), true);

        $limit = intval($queryString['paginate']['limit']) ?? 1000;
        $offset = intval($queryString['paginate']['offset']);

        /** @var EmpresasServiceInterface $empresasService */
        $empresasService = $this->container->get(EmpresasServiceInterface::class);
        $empresas = $empresasService->findBy(
            $queryString['filter'] ?? [],
            $queryString['order'] ?? [],
            ($limit > 1000 ? 1000 : $limit),
            $offset
        );
        return $response->withJson($empresas, 200)->withHeader('Content-type', 'application/json');
    }
}