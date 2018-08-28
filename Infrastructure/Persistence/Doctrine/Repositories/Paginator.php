<?php

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Doctrine\ORM\Query;

/**
 * Doctrine Paginator
 *
 * @author Marcelo Fuchs
 */
class Paginator {
    
    protected $total;

    protected $perPage;
    
    protected $currentPage;
    
    protected $lastPage;
    
    protected $nextPage = null;
    
    protected $prevPage = null;
    
    protected $query;
    
    protected $paginator;
    
    protected $firstItemPage;


    public function __construct(Query $query, $page = 1, $perPage = 10)
    {
        $this->query = $query;
        $this->currentPage = (int) $page;
        $this->perPage = $perPage;
        $this->firstItemPage = ($this->currentPage - 1) * $this->perPage;
        
        $this->setQueryResults();
        $this->paginator = new DoctrinePaginator($this->query);
        $this->total = $this->paginator->count();
        $this->setPages();
    }
    
    private function setQueryResults()
    {
        $this->query
             ->setFirstResult($this->firstItemPage)
             ->setMaxResults($this->perPage);
    }
    
    private function setPages()
    {
        if(($this->firstItemPage + $this->perPage) < $this->total){
            $this->nextPage = $this->currentPage + 1;
        }
        
        if($this->currentPage > 1){
            $this->prevPage = $this->currentPage - 1;
        }
        
        $this->lastPage = ceil($this->total / $this->perPage);
    }
    
    public function getData()
    {
        $result = [
            'total' => $this->total,
            'perPage' => $this->perPage,
            'currentPage' => $this->currentPage,
            //'lastPage' => $this->lastPage,
            //'nextPage' => $this->nextPage,
            //'prevPage' => $this->prevPage,
            'items' => $this->query->getResult()
        ];
        return $result;
    }
}