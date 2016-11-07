<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Sprawozdanie\Controller\Sprawozdanie' => 'Sprawozdanie\Controller\SprawozdanieController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'sprawozdanie' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/sprawozdanie',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sprawozdanie\Controller\Sprawozdanie',
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