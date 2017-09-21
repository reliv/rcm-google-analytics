<?php
/**
 * navigation.php
 */
return [
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
];
