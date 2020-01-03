<?php
/**
 * Базовый класс для миграций, использует \Phpmig\Migration\Migration как основу и добавляет "синтаксический сахар"
 */
namespace App\Infrastructure\DB;

use Doctrine\DBAL\Connection;

class Migration extends \Phpmig\Migration\Migration
{
    /**
     * @return Connection
     */
    public function getConnection() : Connection
    {
        return $this->container['db_connection'];
    }
}