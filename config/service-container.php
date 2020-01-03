<?php
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'service-container' => [
        'abstract_factories' => [
            ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            \Doctrine\DBAL\Connection::class => function (\Psr\Container\ContainerInterface $container) {
                return $container->get('db-connection');
            }
        ]
    ]
];