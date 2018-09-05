<?php
namespace Application\Books\Http\v1\Actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Domain\Contracts\Services\BooksServiceContract;
use \Domain\Abstractions\AbstractAction;

/**
 * Action Create
 */
class BookCreate extends AbstractAction {

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
        
        $data = json_decode($request->getBody()->getContents(), true);
        $entity = new \Domain\Entities\Book();             
        $entity->setAuthor($data['author']);            
        $entity->setName($data['name']);            
        $entity->setDescription($data['description']);
        $books = $this->service->save($entity);
        
        return $response->withJson($books, 200)->withHeader('Content-type', 'application/json');

//        $command = \Repurchase\Application\Command\NewRepurchase::fromArray($data);
//        $this->commandBus->dispatch($command);
//
//        return new JsonResponse([
//            'id' => $command->getRepurchaseId(),
//            'orderId' => $command->getPortalOrderId(),
//            'success' => (!empty($command->getRepurchaseId()))
//        ], 202);
    }
    
//    /**
//     * Cria um livro
//     * 
//     * @param [type] $request
//     * @param [type] $response
//     * @param [type] $args
//     * @return Response
//     */
//    public function createBook(Request $request, $response, $args) {
//        $params = (object) $request->getParams();
//      //  print_r()
//        /**
//         * Pega o Entity Manager do nosso Container
//         */
//        $booksRepository = $this->container->get(\Domain\Contracts\Repositories\BooksRepositoryContract::class);
//        
//        /**
//         * Instância da nossa Entidade preenchida com nossos parametros do post
//         */
//        $book = (new Book())->setName($params->name)
//            ->setAuthor($params->author);
//        
//        /**
//         * Registra a criação do livro
//         */
////        $logger = $this->container->get('logger');
////        $logger->info('Book Created!', $book->getValues());
//
//        /**
//         * Persiste a entidade no banco de dados
//         */
//        $booksRepository->persist($book);
//        $booksRepository->flush();
//        $return = $response->withJson($book, 201)
//            ->withHeader('Content-type', 'application/json');
//        return $return;       
//    }

//    /**
//     * Exibe as informações de um livro 
//     * @param [type] $request
//     * @param [type] $response
//     * @param [type] $args
//     * @return Response
//     */
//    public function viewBook($request, $response, $args) {
//
//        $id = (int) $args['id'];
//
//        $entityManager = $this->container->get('em');
//        $booksRepository = $entityManager->getRepository('Domain\Entities\Book');
//        $book = $booksRepository->find($id); 
//
//        /**
//         * Verifica se existe um livro com a ID informada
//         */
//        if (!$book) {
//            $logger = $this->container->get('logger');
//            $logger->warning("Book {$id} Not Found");
//            throw new \Exception("Book not Found", 404);
//        }    
//
//        $return = $response->withJson($book, 200)
//            ->withHeader('Content-type', 'application/json');
//        return $return;   
//    }
//
//    /**
//     * Atualiza um Livro
//     * @param [type] $request
//     * @param [type] $response
//     * @param [type] $args
//     * @return Response
//     */
//    public function updateBook($request, $response, $args) {
//
//        $id = (int) $args['id'];
//
//        /**
//         * Encontra o Livro no Banco
//         */ 
//        $entityManager = $this->container->get('em');
//        $booksRepository = $entityManager->getRepository('Domain\Entities\Book');
//        $book = $booksRepository->find($id);   
//
//        /**
//         * Verifica se existe um livro com a ID informada
//         */
//        if (!$book) {
//            $logger = $this->container->get('logger');
//            $logger->warning("Book {$id} Not Found");
//            throw new \Exception("Book not Found", 404);
//        }  
//
//        /**
//         * Atualiza e Persiste o Livro com os parâmetros recebidos no request
//         */
//        $book->setName($request->getParam('name'))
//            ->setAuthor($request->getParam('author'));
//
//        /**
//         * Persiste a entidade no banco de dados
//         */
//        $entityManager->persist($book);
//        $entityManager->flush();        
//        
//        $return = $response->withJson($book, 200)
//            ->withHeader('Content-type', 'application/json');
//        return $return;       
//    }
//
//    /**
//     * Deleta um Livro
//     * @param [type] $request
//     * @param [type] $response
//     * @param [type] $args
//     * @return Response
//     */
//    public function deleteBook($request, $response, $args) {
//
//        $id = (int) $args['id'];
//
//        /**
//         * Encontra o Livro no Banco
//         */ 
//        $entityManager = $this->container->get('em');
//        $booksRepository = $entityManager->getRepository('App\Models\Entity\Book');
//        $book = $booksRepository->find($id);   
//
//        /**
//         * Verifica se existe um livro com a ID informada
//         */
//        if (!$book) {
//            $logger = $this->container->get('logger');
//            $logger->warning("Book {$id} Not Found");
//            throw new \Exception("Book not Found", 404);
//        }  
//
//        /**
//         * Remove a entidade
//         */
//        $entityManager->remove($book);
//        $entityManager->flush(); 
//        $return = $response->withJson(['msg' => "Deletando o livro {$id}"], 204)
//            ->withHeader('Content-type', 'application/json');
//        return $return;    
//    }
    
}