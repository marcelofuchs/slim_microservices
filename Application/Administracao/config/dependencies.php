<?php

//ACTIONS - EXECUTA ACOES HTTP
$container[\Application\Administracao\Http\Actions\Empresas\EmpresaCreate::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Administracao\Http\Actions\Empresas\EmpresaCreate::class);
};

$container[\Application\Administracao\Http\Actions\Empresas\EmpresaOne::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Administracao\Http\Actions\Empresas\EmpresaOne::class);
};

$container[\Application\Administracao\Http\Actions\Empresas\EmpresaList::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Administracao\Http\Actions\Empresas\EmpresaList::class);
};

$container[\Application\Administracao\Http\Actions\Empresas\EmpresaDelete::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Administracao\Http\Actions\Empresas\EmpresaDelete::class);
};

$container[\Application\Administracao\Http\Actions\Empresas\EmpresaUpdate::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Administracao\Http\Actions\Empresas\EmpresaUpdate::class);
};

//COMMANDS - É CHAMADO TANTO PELO HTTP QUANTO PELO CONSOLE PARA PREPARAR UMA INFORMAÇÃO PARA O HANDLER
$container[\Application\Administracao\Contracts\Commands\Empresas\EmpresaCreateInterface::class] = \Application\Administracao\Commands\Empresas\EmpresaCreate::class;
$container[\Application\Administracao\Contracts\Commands\Empresas\EmpresaUpdateInterface::class] = \Application\Administracao\Commands\Empresas\EmpresaUpdate::class;
$container[\Application\Administracao\Contracts\Commands\Empresas\EmpresaDeleteInterface::class] = \Application\Administracao\Commands\Empresas\EmpresaDelete::class;

//HANDLERS - EXECUTAM E MANIPULAM AS TAREFA.
$container[\Application\Administracao\Contracts\Handlers\EmpresaHandlerInterface::class] = function ($container) {
    return new   \Application\Administracao\Handlers\EmpresaHandler(
        $container->get(\Domain\Contracts\Services\EmpresasServiceInterface::class)
    );
};

$container['command_bus'] = [
    'handlers' => [
        \Application\Administracao\Contracts\Handlers\EmpresaHandlerInterface::class
    ]
];

return $container;
