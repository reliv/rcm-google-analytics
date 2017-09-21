<?php

namespace Reliv\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmAdminConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
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
    }
}
