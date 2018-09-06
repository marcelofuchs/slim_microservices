<?php
namespace Application\Books\Http\v1\Actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceContract;
use \Domain\Abstractions\AbstractAction;

/**
 * Action Create
 */
class BookDelete extends AbstractAction {

    /**
     * Container Class
     * 
     * @var \Domain\Contracts\Services\BaseServiceContract
     */
    private $service;

    /**
     * @inheritdoc
     */
    public function __construct($container) {
        parent::__construct($container);
        $this->service = $this->container->get(BooksServiceContract::class);
    }
    
    /**
     * Cria um novo cadastro de Livro
     * 
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args=[]) {   
       $id = (int) $args['id'];

       $this->service->delete($id);

       $return = $response->withJson(['msg' => "Deletando o livro {$id}"], 204)
                 ->withHeader('Content-type', 'application/json');
       return $return;  
    }
}