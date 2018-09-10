<?php

namespace Application\Books\Http\v1\Actions;

use Domain\Abstractions\AbstractAction;
use Domain\Contracts\Services\BooksServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Action Create
 */
class BookOne extends AbstractAction
{

    /**
     * Container Class
     *
     * @var \Domain\Contracts\Services\BaseServiceInterface
     */
    private $service;

    /**
     * @inheritdoc
     */
    public function __construct($container)
    {
        parent::__construct($container);
        $this->service = $this->container->get(BooksServiceInterface::class);
    }

    /**
     * Invoke
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, $args = [])
    {
        $id = (int) $args['id'];

        $book = $this->service->find($id);

        return $response->withJson($book, 200)->withHeader('Content-type', 'application/json');
    }
}
