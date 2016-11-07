<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Zarzadzanie\Controller\Zarzadzanie' => 'Zarzadzanie\Controller\ZarzadzanieController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'zarzadzanie' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/zarzadzanie',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Zarzadzanie\Controller\Zarzadzanie',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);