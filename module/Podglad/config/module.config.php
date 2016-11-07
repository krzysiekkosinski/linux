<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Podglad\Controller\Podglad' => 'Podglad\Controller\PodgladController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'podglad' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/podglad',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Podglad\Controller\Podglad',
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