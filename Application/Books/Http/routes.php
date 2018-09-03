<?php

/**
 * Grupo dos enpoints iniciados por v1
 */
$app->group('/v1', function() {

    /**
     * Dentro de v1, o recurso /book
     */
    $this->group('/book', function() {
        $this->get('', Application\Books\Http\v1\Actions\BookList::class);
        $this->post('', Application\Books\Http\v1\Actions\BookCreate::class);
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\Application\Books\Http\v1\Controllers\BookController:viewBook');
        $this->put('/{id:[0-9]+}', '\Application\Books\Http\v1\Controllers\BookController:updateBook');
        $this->delete('/{id:[0-9]+}', '\Application\Books\Http\v1\Controllers\BookController:deleteBook');
    });
    
});
