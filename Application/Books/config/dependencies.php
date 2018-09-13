<?php

//ACTIONS
$container[\Application\Books\Http\Actions\BookCreate::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookCreate::class);
};

$container[\Application\Books\Http\Actions\BookList::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\Actions\BookList::class);
};

//COMMANDS
$container[\Application\Books\Contracts\Commands\BookCreateInterface::class] = \Application\Books\Commands\BookCreate::class;


$container['command_bus'] = [
    'handlers' => [
       Book
    ]
];

return $container;
