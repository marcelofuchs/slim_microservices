<?php

namespace Infrastructure\Persistence\PDO;


/**
 * Description of EntityManager
 *
 * @author Willian
 */
class EntityManager implements \Domain\Contracts\Persistence\EntityManagerInterface
{

    protected $connection;

    public function __construct($connection = null)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritdoc
     */
    public static function create($settings = [], $name = null)
    {
        $dsn = "{$settings['connection']['driver']}:host={$settings['connection']['host']};port={$settings['connection']['port']};dbname={$settings['connection']['dbname']}";

        $connection = new \PDO($dsn, $settings['connection']['user'], $settings['connection']['password']);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return new EntityManager($connection);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}