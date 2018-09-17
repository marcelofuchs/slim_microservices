<?php

//ACTIONS - EXECUTA ACOES HTTP
$container[\Application\Books\Http\Actions\BookCreate::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookCreate::class);
};

$container[\Application\Books\Http\Actions\BookOne::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookOne::class);
};

$container[\Application\Books\Http\Actions\BookList::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookList::class);
};

$container[\Application\Books\Http\Actions\BookDelete::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookDelete::class);
};

$container[\Application\Books\Http\Actions\BookUpdate::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookUpdate::class);
};

//COMMANDS - É CHAMADO TANTO PELO HTTP QUANTO PELO CONSOLE PARA PREPARAR UMA INFORMAÇÃO PARA O HANDLER
$container[\Application\Books\Contracts\Commands\BookCreateInterface::class] = \Application\Books\Commands\BookCreate::class;
$container[\Application\Books\Contracts\Commands\BookUpdateInterface::class] = \Application\Books\Commands\BookUpdate::class;
$container[\Application\Books\Contracts\Commands\BookDeleteInterface::class] = \Application\Books\Commands\BookDelete::class;



//HANDLERS - EXECUTAM E MANIPULAM AS TAREFA.
$container[\Application\Books\Contracts\Handlers\BookHandlerInterface::class] = function ($container) {
    return new   \Application\Books\Handlers\BookHandler(
        $container->get(\Domain\Contracts\Services\BooksServiceInterface::class)
    );
};

$container['command_bus'] = [
    'handlers' => [
        \Application\Books\Contracts\Handlers\BookHandlerInterface::class
    ]
];

return $container;
