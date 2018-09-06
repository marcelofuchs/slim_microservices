<?php
namespace Application\Books\Http\v1\Actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceInterface;
use \Domain\Abstractions\AbstractAction;

/**
 * Action List
 */
class BookList extends AbstractAction {

    /**
     * Container Class
     * 
     * @var \Domain\Contracts\Service\BooksServiceContract
     */
    private $service;

    /**
     * @inheritdoc
     */
    public function __construct($container) {
        parent::__construct($container);
        $this->service = $this->container->get(BooksServiceInterface::class);
    }
    
    /**
     * Listagem de Livros
     * 
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args=[]) {
        $books = $this->service->findAll();
        return $response->withJson($books, 200)->withHeader('Content-type', 'application/json');
    }    
}