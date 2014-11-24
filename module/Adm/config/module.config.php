<?php

namespace Adm;

return array(
    'router' => array(
        'routes' => array(
            'adm' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/adm',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Adm\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => '/[:controller[/:action]][/id/:id][/page/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Adm\Controller',
                                'controller'    => 'Index'
                            )
                        )
                    ),
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.php',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Adm\Controller\Index'      => 'Adm\Controller\IndexController',
            'Adm\Controller\Militar'    => 'Adm\Controller\MilitarController',
            'Adm\Controller\Ala'        => 'Adm\Controller\AlaController',
            'Adm\Controller\Servico'    => 'Adm\Controller\ServicoController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => array(
            'error/404'   => __DIR__ . '/../view/error/404.phtml',
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
