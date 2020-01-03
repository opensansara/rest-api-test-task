<?php
use Doctrine\DBAL\DBALException;

class AddProductsTable extends \App\Infrastructure\DB\Migration
{
    /**
     * Do the migration
     * @throws DBALException
     */
    public function up()
    {
        $tableName = $this->getTableName();

        $sql = <<<SQL
CREATE TABLE `{$tableName}` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `price` INT NULL,
  PRIMARY KEY (`id`));
SQL;
        $this->getConnection()->exec($sql);
    }

    /**
     * Undo the migration
     * @throws DBALException
     */
    public function down()
    {
        $this->getConnection()->exec('DROP TABLE ' . $this->getTableName());
    }

    private function getTableName() : string
    {
        return 'products';
    }
}
