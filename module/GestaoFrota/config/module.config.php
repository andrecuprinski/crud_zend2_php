<?php

namespace GestaoFrota;

return [
    'controllers' => [
        'factories' => [
            'motorista' => function($container) {
                $parentLocator = $container->getServiceLocator();
                $motoristaService = $parentLocator->get('GestaoFrota\Service\Motorista\Motorista');
                return new \GestaoFrota\Controller\Motorista\MotoristaController($motoristaService);
            },
            'veiculo' => function($container) {
                $parentLocator = $container->getServiceLocator();
                $veiculoService = $parentLocator->get('GestaoFrota\Service\Veiculo\Veiculo');
                return new \GestaoFrota\Controller\Veiculo\VeiculoController($veiculoService);
            },
        ],
    ],
    'router' => [
        'routes' => [
            'gestao-frota' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/gestao-frota[/:controller[/:action]]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'index',
                        'action' => 'index',
                        'module' => 'GestaoFrota',
                        'moduleUri' => 'gestao-frota'
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
            'GestaoFrota\Model\Veiculos' => function($sm) {
                $tableGateway = $sm->get('VeiculosTableGateway');
                return new \GestaoFrota\Model\Veiculos($tableGateway);
            },
            'GestaoFrota\Model\Motoristas' => function($sm) {
                $tableGateway = $sm->get('MotoristasTableGateway');
                return new \GestaoFrota\Model\Motorista($tableGateway);
            },
            'GestaoFrota\Service\Veiculo\Veiculo' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                return new \GestaoFrota\Service\Veiculo\Veiculo($dbAdapter);
            },
            'GestaoFrota\Service\Motorista\Motorista' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                $veiculoService = $serviceManager->get('GestaoFrota\Service\Veiculo\Veiculo');
                return new \GestaoFrota\Service\Motorista\Motorista($dbAdapter, $veiculoService);
            },
        ],
    ],
    'VeiculosTableGateway' => [
        'class' => 'Zend\Db\TableGateway\TableGateway',
        'parameters' => [
            'table' => 'veiculos',
            'adapter' => 'Zend\Db\Adapter\Adapter',
        ],
    ],
    'MotoristasTableGateway' => [
        'class' => 'Zend\Db\TableGateway\TableGateway',
        'parameters' => [
            'table' => 'motoristas',
            'adapter' => 'Zend\Db\Adapter\Adapter',
        ],
    ],
    'phpSettings' => [
        'display_errors' => 'On',  // Enable error display
        'error_reporting' => E_ALL, // Report all errors
    ],
    'view_manager' => [
        'display_exceptions' => true,
        'template_path_stack' => [
            'gestao-frota' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];

