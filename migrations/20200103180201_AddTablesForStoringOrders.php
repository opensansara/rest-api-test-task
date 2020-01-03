<?php

use Phpmig\Migration\Migration;

class AddTablesForStoringOrders extends \App\Infrastructure\DB\Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $ordersTableSql = <<<SQL
CREATE TABLE `orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `price` INT NOT NULL,
  `status_id` INT NOT NULL,
  `date_create` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
SQL;

        $orderProductsTableSql = <<<SQL
CREATE TABLE `order_products` (
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  PRIMARY KEY (`order_id`, `product_id`));
SQL;

        $this->getConnection()->transactional(function ($connection) use ($ordersTableSql, $orderProductsTableSql) {
            $connection->exec($ordersTableSql);
            $connection->exec($orderProductsTableSql);
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getConnection()->transactional(function ($connection) {
            $connection->exec('DROP TABLE orders');
            $connection->exec('DROP TABLE order_products');
        });
    }
}
