<?php
/**
 * @var Doctrine\DBAL\Connection $connection
 */
use \Phpmig\Adapter;

require __DIR__ . '/config/bootstrap.php';

$container = new ArrayObject();

$container['db_connection'] = $connection;

$container['phpmig.adapter'] = new Adapter\File\Flat(__DIR__ . DIRECTORY_SEPARATOR . 'migrations/.migrations.log');
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;