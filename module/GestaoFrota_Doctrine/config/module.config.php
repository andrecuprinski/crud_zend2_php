<?php

namespace GestaoFrota_Doctrine;

use Doctrine\ORM\EntityManager;

return [
    'controllers' => [
        'invokables' => [
            'motorista-doctrine' => \GestaoFrota_Doctrine\Controller\Motorista\MotoristaController::class
        ],
    ],
    'router' => [
        'routes' => [
            'gestao-frota-doctrine' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/gestao-frota-doctrine[/:controller[/:action]]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'index',
                        'action' => 'index',
                        'module' => 'GestaoFrota_Doctrine',
                        'moduleUri' => 'gestao-frota-doctrine'
                    ],
                ],
                'child_routes' => [
                    'wildcard' => [
                        'type' => 'Wildcard'
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',

        ],
        'factories' => [
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            \Doctrine\ORM\EntityManager::class => function($container) {
                return $container->get('doctrine.entitymanager.orm_default');
            },
            'GestaoFrota_Doctrine\Controller\Motorista\MotoristaController' => function($container) {
                return new \GestaoFrota_Doctrine\Controller\Motorista\MotoristaController(
                    $container->get(\Doctrine\ORM\EntityManager::class)
                );
            },
        ],
    ],
    'phpSettings' => [
        'display_errors' => 'On',  // Enable error display
        'error_reporting' => E_ALL, // Report all errors
    ],
    'view_manager' => [
        'display_exceptions' => true,
        'template_path_stack' => [
            'gestao-frota-doctrine' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'GestaoFrota_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/GestaoFrota_Doctrine/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'GestaoFrota_Doctrine\Entity' => 'GestaoFrota_driver'
                ]
            ]
        ]
    ],
];

