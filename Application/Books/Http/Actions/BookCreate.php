<?php

namespace Application\Books\Http\Actions;

use Application\Books\Contracts\Commands\BookCreateInterface;
use Domain\Abstractions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\Request;

/**
 * Action Create
 */
class BookCreate extends AbstractAction
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

        /** @var BookCreateInterface $command */
        $command = $this->container->get(BookCreateInterface::class)::fromArray($data);
        $this->commandBus->dispatch($command);

        return $response->withJson($command->toArray(), 202);
    }
}
