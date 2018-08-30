<?php

//Caso tenha configurações especificas para a applicacao, criar merge aqui.
$sets = require_once __DIR__.'/../../../config/settings.global.php';

$sets['settings']['mm_crm']['cache_dir'] = __DIR__ . '/../../../'. getenv('DOCTRINE_CACHE_DIR');
$sets['settings']['mm_crm']['metadata_dirs'] = [__DIR__ . '/../../../'. getenv('DOCTRINE_METADATA_DIR')];

return $sets;