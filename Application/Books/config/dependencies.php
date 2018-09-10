<?php

//ACTIONS
$container[\Application\Books\Http\v1\Actions\BookCreate::class] = \Infrastructure\Container\Factory\Actions\BaseActionFactory::class;
$container[\Application\Books\Http\v1\Actions\BookList::class] =  function($container) {
    return new \Infrastructure\Container\Factory\Actions\BaseActionFactory;
};

return $container;
