<?php

/**
 * Grupo dos enpoints iniciados por v1
 */
$app->group('/v1', function ($app) {

    /**
     * Dentro de v1, o recurso /book
     */
    $this->group('/empresas', function () {
        $this->get('', \Application\Administracao\Http\Actions\Empresas\EmpresaList::class)->setName("empresa.list");
        $this->get('/{id:[0-9]+}', \Application\Administracao\Http\Actions\Empresas\EmpresaOne::class)->setName("empresa.one");
        $this->put('/{id:[0-9]+}', \Application\Administracao\Http\Actions\Empresas\EmpresaUpdate::class)->setName("empresa.update");
        $this->post('', \Application\Administracao\Http\Actions\Empresas\EmpresaCreate::class)->setName("empresa.create");
        $this->delete('/{id:[0-9]+}', \Application\Administracao\Http\Actions\Empresas\EmpresaDelete::class)->setName("empresa.delete");
    })->add(new \Infrastructure\Container\Middleware\JsonGuardMiddleware($app));
});
