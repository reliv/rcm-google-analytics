<?php
return [
    /**
     * Configuration
     */
    'Reliv\RcmGoogleAnalytics' => [
        'javascript-view' => __DIR__ . '/../view/gaq.js.phtml'
    ],

    'doctrine' => [
        'driver' => [
            'Reliv\RcmGoogleAnalytics' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Reliv\RcmGoogleAnalytics' => 'Reliv\RcmGoogleAnalytics'
                ]
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'doctrine_cache',
                'query_cache' => 'doctrine_cache',
                'result_cache' => 'doctrine_cache',
            ]
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics' => 'Reliv\RcmGoogleAnalytics\Factory\RcmGoogleAnalyticsServiceFactory'
        ]
    ],

    'controllers' => [
        'invokables' => [
            'Reliv\RcmGoogleAnalytics\Controller\VerificationController' =>
                'Reliv\RcmGoogleAnalytics\Controller\VerificationController',
        ]
    ],
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
    'router' => [
        'routes' => [
            'Reliv\RcmGoogleAnalytics\Verification' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/google[:verificationCode].html',
                    'defaults' => [
                        'controller' => 'Reliv\RcmGoogleAnalytics\Controller\VerificationController',
                        'action' => 'index',
                    ],
                ],
            ],
        ]
    ]
];
