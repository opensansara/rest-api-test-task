<?php
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'service-container' => [
        'abstract_factories' => [
            ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [

        ]
    ]
];