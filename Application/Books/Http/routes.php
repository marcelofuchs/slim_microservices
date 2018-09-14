<?php

/**
 * Grupo dos enpoints iniciados por v1
 */
$app->group('/v1', function() {

    /**
     * Dentro de v1, o recurso /book
     */
    $this->group('/book', function() {
        $this->get('', Application\Books\Http\Actions\BookList::class);
        $this->get('/{id:[0-9]+}', Application\Books\Http\Actions\BookOne::class);
        $this->put('/{id:[0-9]+}', Application\Books\Http\Actions\BookUpdate::class);
        $this->post('', Application\Books\Http\Actions\BookCreate::class);
        $this->delete('/{id:[0-9]+}', Application\Books\Http\Actions\BookDelete::class);
    });
});
