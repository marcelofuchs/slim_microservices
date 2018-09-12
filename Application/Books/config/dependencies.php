<?php

//ACTIONS
$container[\Application\Books\Http\v1\Actions\BookCreate::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\v1\Actions\BookCreate::class);
};

$container[\Application\Books\Http\v1\Actions\BookList::class] = function ($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory($container, \Application\Books\Http\v1\Actions\BookList::class);
};

$container['command_bus'] = [
    'middlewares' => [

    ]
];

return $container;
