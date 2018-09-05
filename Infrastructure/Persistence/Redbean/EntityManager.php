<?php

namespace Infrastructure\Persistence\Redbean;

use \RedBeanPHP\R;

/**
 * Description of EntityManager
 *
 * @author marcelo
 */
class EntityManager implements \Domain\Contracts\Persistence\EntityManagerContract {

    /**
     * @inheritdoc
     */
    public static function create($settings = [], $name = null) {
        $dsn = "{$settings['connection']['driver']}:host={$settings['connection']['host']};port={$settings['connection']['port']};dbname={$settings['connection']['dbname']}";
        if (!$name) {
            R::setup($dsn, $settings['connection']['user'], $settings['connection']['password']);
        } else {
            R::addDatabase($name, $dsn, $settings['connection']['user'], $settings['connection']['password']);
        }
        return new EntityManager();
    }
}
