<?php
return [
    /*
     * asset_manager
     */
    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'modules/rcm-google-analytics/' => __DIR__ . '/../public/',
            ],
            'collections' => [
                'modules/rcm/modules.js' => [
                    'modules/rcm-google-analytics/js/rcm-google-analytics.js',
                ],
                'modules/rcm/modules.css' => [
                    'modules/rcm-google-analytics/css/loading.css',
                    'modules/rcm-google-analytics/css/admin-analytics.css'
                ],
            ],
        ],
    ],

    /*
     * Controllers
     */
    'controllers' => [
        'invokables' => [
            \Reliv\RcmGoogleAnalytics\Controller\VerificationController::class =>
                \Reliv\RcmGoogleAnalytics\Controller\VerificationController::class,
            \Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController::class =>
                \Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController::class,
            \Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController::class =>
                \Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController::class
        ],
    ],

    /*
     * Doctrine config
     */
    'doctrine' => [
        'driver' => [
            'Reliv\RcmGoogleAnalytics' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Reliv\RcmGoogleAnalytics' => 'Reliv\RcmGoogleAnalytics'
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'doctrine_cache',
                'query_cache' => 'doctrine_cache',
                'result_cache' => 'doctrine_cache',
            ],
        ],
    ],

    /**
     * Set for rcm-admin module
     */
    'navigation' => [
        'RcmAdminMenu' => [
            'Site' => [
                'pages' => [
                    'Google Analytics' => [
                        'label' => 'Google Analytics',
                        'class' => 'rcmAdminMenu rcmStandardDialog',
                        'uri' => '/modules/rcm-google-analytics/admin-analytics.html',
                        'title' => 'Google Analytics Settings',
                    ]
                ]
            ],
        ],
    ],

    /*
     * Config for RcmUser ACL Resource Provider
     * - ONLY used if configured for
     * 'Reliv\RcmGoogleAnalytics\Factory\AnalyticsAccessRcmUserAclFactory'
     * With default settings
     */
    'RcmUser' => [
        'Acl\Config' => [
            'ResourceProviders' => [
                'RcmGoogleAnalytics' => \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider::class,
            ],
        ],
    ],

    /*
     * Configuration
     */
    'Reliv\RcmGoogleAnalytics' => [
        'use-analytics' => true,
        'javascript-view' => 'test.js.phtml',
        /**
         * For use with:
         * 'AnalyticsAccessRcmUserAcl' and/or 'RcmGoogleAnalyticsResourceProvider'
         */
        'acl-resource-config' => [
            'providerId' => 'Reliv\RcmGoogleAnalytics\Acl\ResourceProvider',
            'resourceId' => \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider::RESOURCE_ID,
            'privilege' => \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider::PRIVILEGE_ADMIN,
        ],
    ],

    /*
     * Routes
     */
    'router' => [
        'routes' => [
            'Reliv\RcmGoogleAnalytics\Verification' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/google[:verificationCode].html',
                    'defaults' => [
                        'controller' => \Reliv\RcmGoogleAnalytics\Controller\VerificationController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'Reliv\RcmGoogleAnalytics\RcmGoogleAnalytics' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/rcm-google-analytics',
                    'defaults' => [
                        'controller' => \Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'Reliv\RcmGoogleAnalytics\ApiRcmGoogleAnalyticsSite' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/api/rcm-google-analytics[/:id]',
                    'defaults' => [
                        'controller' => \Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController::class,
                    ],
                ],
            ],
        ],
    ],

    /*
     * service_manager
     */
    'service_manager' => [
        'factories' => [
            /*
             * Service
             */
            \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics::class
            => \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalyticsServiceFactory::class,
            /*
             * RcmUser Resource Provider
             */
            \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider::class
            => \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProviderFactory::class,
            /*
             * Set access based on RcmUser Acl Resources
             * Configured by acl-resource-config config settings
             * By default will use 'RcmGoogleAnalyticsResourceProvider'
             */
            \Reliv\RcmGoogleAnalytics\Service\AnalyticsAccess::class
            => \Reliv\RcmGoogleAnalytics\Model\AnalyticsAccessRcmUserAclFactory::class,

            /*
             * Set NO access controls NOT RECOMMENDED
             */
            //\Reliv\RcmGoogleAnalytics\Service\AnalyticsAccess::class
            //  => 'Reliv\RcmGoogleAnalytics\Model\AnalyticsAccessAnyFactory',

        ],
    ],

    /*
     * Views
     */
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    /*
     * View Helpers
     */
    'view_helpers' => [
        'factories' => [
            'rcmGoogleAnalytics'
            => \Reliv\RcmGoogleAnalytics\View\Helper\RcmGoogleAnalyticsViewHelperFactory::class,
        ],
    ],
];
