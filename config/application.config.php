<?php
/**
 * If you need an environment-specific system or application configuration,
 * there is an example in the documentation
 * @see http://framework.zend.com/manual/current/en/tutorials/config.advanced.html#environment-specific-system-configuration
 * @see http://framework.zend.com/manual/current/en/tutorials/config.advanced.html#environment-specific-application-configuration
 */
return array(
    'modules' => [
        'DoctrineModule',
        'DoctrineORMModule',
        'Application',
        'GestaoFrota',
        'GestaoFrota_Doctrine',
    ],

    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),

        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
            'config/autoload/{,*.}doctrine_orm.local.php',
        ),
    ),
);
