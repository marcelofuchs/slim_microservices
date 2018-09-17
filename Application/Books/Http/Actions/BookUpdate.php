<?php

namespace Application\Books\Http\Actions;

use Application\Books\Contracts\Commands\BookUpdateInterface;
use Domain\Abstractions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceInterface;
use Slim\Http\Request;

class BookUpdate extends AbstractAction
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
        $command = $this->container->get(BookUpdateInterface::class)::fromArray($data);
        $this->commandBus->dispatch($command);

        return $response->withJson($command->toArray(), 201);
    }
}