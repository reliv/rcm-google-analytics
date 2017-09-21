<?php
/**
 * asset_manager.php
 */
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
                // For Rcm CoreJs
                'modules/rcm/modules.js' => [
                    'modules/rcm-google-analytics/js/rcm-google-analytics.js',
                    'modules/rcm-google-analytics/js/rcm-core.js',
                ],
                'modules/rcm/modules.css' => [
                    'modules/rcm-google-analytics/css/loading.css',
                    'modules/rcm-google-analytics/css/admin-analytics.css'
                ],
            ],
        ],
    ],
];
