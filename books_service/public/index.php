<?php

/**
 * Bootstrap da API
 */
require __DIR__.'/../src/bootstrap.php';

/**
 * Rotas da API
 */
require __DIR__.'/../config/routes.php';

$app->run();