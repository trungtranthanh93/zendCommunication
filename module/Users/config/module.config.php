<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Users/Entity'
                )
            ),
            
            'orm_default' => array(
                'drivers' => array(
                    'Users\Entity' => 'application_entities'
                )
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Users\Entity\User',
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credentialCallable' => function ($userObj, $password) {
                    return ($userObj->getPassword() === md5($password));
                }
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\Index' => 'Users\Controller\IndexController',
            'Users\Controller\Register' => 'Users\Controller\RegisterController',
            'Users\Controller\Login' => 'Users\Controller\LoginController',
            'Users\Controller\UserManager' => 'Users\Controller\UserManagerController'
        )
    )
    ,
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/users',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'register' => array(
                        'type' => 'Segment',
                        'may_terminate' => true,
                        'options' => array(
                            'route' => '/register[/:action]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Users\Controller\Register',
                                'action' => 'index'
                            )
                        )
                    ),
                    'login' => array(
                        'type' => 'Segment',
                        'may_terminate' => true,
                        'options' => array(
                            'route' => '/login[/:action]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Users\Controller\login',
                                'action' => 'index'
                            )
                        )
                    ),
                    'user-manager' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/user-manager[/:action[/:id]]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Users\Controller\UserManager',
                                'action' => 'index'
                            )
                        )
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ZendSkeletonModule' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/default-layout.phtml',
            'layout/myaccount' => __DIR__ . '/../view/layout/myaccount-layout.phtml'
        )
    ),
    'module_config' => array(
        'upload_location' => __DIR__ . '/../data/uploads'
    )
);
