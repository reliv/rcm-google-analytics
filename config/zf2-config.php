<?php
return [
    /*
     * ZF2 Controllers
     */
    'controllers' => [
        'factories' => [
            \Reliv\RcmGoogleAnalytics\Controller\VerificationController::class =>
                \Reliv\RcmGoogleAnalytics\Controller\VerificationControllerFactory::class,
            \Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsController::class =>
                \Reliv\RcmGoogleAnalytics\Controller\RcmGoogleAnalyticsControllerFactory::class,
            \Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsController::class =>
                \Reliv\RcmGoogleAnalytics\Controller\ApiRcmGoogleAnalyticsControllerFactory::class
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

    'service_manager' => [
        'factories' => [
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
