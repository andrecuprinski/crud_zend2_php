<?php

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=gestao_frota;host=host.docker.internal;port=8889',
        'username' => 'root',
        'password' => 'root',
        'driver_options' => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Doctrine\ORM\EntityManager' => 'DoctrineORMModule\Service\EntityManagerFactory',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'basePath' => function ($sm) {
                $helper = new Zend\View\Helper\BasePath();
                $helper->setBasePath('/');
                return $helper;
            },
        ],
    ],
];
