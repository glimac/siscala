<?php

namespace Autenticacao;

return array(
    'router' => array(
        'routes' => array(
            'autenticacao' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/autenticacao',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Autenticacao\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                 ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id][/page/:page]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Autenticacao\Controller',
                                'controller' => 'Index'
                            )
                        )
                    ),
                    'captcha_form' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/[:controller[/[:action[/]]]]',
                             'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                    'captcha_form_generate' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    =>  '/[:controller[/captcha/[:id]]]',
                             'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Index',
                                'action'     => 'generate',
                             ),
                        ),
                   ),
                ),
            ),
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Autenticacao\Controller\Index' => 'Autenticacao\Controller\IndexController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);