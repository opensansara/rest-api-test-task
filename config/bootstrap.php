<?php
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Dotenv\Dotenv;
use Zend\ServiceManager\ServiceManager;

require dirname(__DIR__).'/vendor/autoload.php';

// Загрузка файлов окружения
(new Dotenv(false))->loadEnv(dirname(__DIR__).'/.env');

$_SERVER += $_ENV;
$_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? null) ?: 'dev';
$_SERVER['APP_DEBUG'] = $_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? 'prod' !== $_SERVER['APP_ENV'];

// Инициализация сервис-контейнера
$serviceContainerConfig = require dirname(__DIR__) . '/config/service-container.php';
$serviceContainer = new ServiceManager($serviceContainerConfig['service-container']);

// Подключение к БД
$connectionParams = array(
    'url' => $_ENV['DATABASE_URL'],
);
$connection = DriverManager::getConnection($connectionParams);
$serviceContainer->setService('db-connection', $connection);

// Авторизация, для простоты полагаем что пользователь всегда авторизован
$user = new \App\Infrastructure\User(1, 'admin');
$serviceContainer->setService('user', $user);