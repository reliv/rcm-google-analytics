<?php
return [
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
            'resourceId' => 'rcm-google-analytics',
            'privilege' => 'admin',
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
                'RcmGoogleAnalytics' => 'Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider',
            ],
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
    'service_manager' => [
        'factories' => [
            /*
             * Service
             */
            'Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics'
                => 'Reliv\RcmGoogleAnalytics\Factory\RcmGoogleAnalyticsServiceFactory',
            /*
             * RcmUser Resource Provider
             */
            'Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider'
                => 'Reliv\RcmGoogleAnalytics\Factory\RcmGoogleAnalyticsResourceProviderFactory',
            /*
             * Set access based on RcmUser Acl Resources
             * Configured by acl-resource-config config settings
             * By default will use 'RcmGoogleAnalyticsResourceProvider'
             */
            'Reliv\RcmGoogleAnalytics\AnalyticsAccess'
                => 'Reliv\RcmGoogleAnalytics\Factory\AnalyticsAccessRcmUserAclFactory',

            /*
             * Set NO access controls NOT RECOMMENDED
             */
            //'Reliv\RcmGoogleAnalytics\AnalyticsAccess'
            //  => 'Reliv\RcmGoogleAnalytics\Factory\AnalyticsAccessAnyFactory',

        ],
    ],
    /*
     * Controllers
     */
    'controllers' => [
        'invokables' => [
            'Reliv\RcmGoogleAnalytics\Controller\VerificationController' =>
                'Reliv\RcmGoogleAnalytics\Controller\VerificationController',
            'Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController' =>
                'Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController',
            'Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController' =>
                'Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController'
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
    'view_helpers' => [
        'factories' => [
            'rcmGoogleAnalytics'
            => 'Reliv\RcmGoogleAnalytics\Factory\RcmGoogleAnalyticsViewHelperFactory',
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
                        'controller' => 'Reliv\RcmGoogleAnalytics\Controller\VerificationController',
                        'action' => 'index',
                    ],
                ],
            ],
            'Reliv\RcmGoogleAnalytics\RcmGoogleAnalytics' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/rcm-google-analytics',
                    'defaults' => [
                        'controller' => 'Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController',
                        'action' => 'index',
                    ],
                ],
            ],
            'Reliv\RcmGoogleAnalytics\ApiRcmGoogleAnalyticsSite' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/api/rcm-google-analytics[/:id]',
                    'defaults' => [
                        'controller' => 'Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController',
                    ],
                ],
            ],
        ],
    ],
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
];
