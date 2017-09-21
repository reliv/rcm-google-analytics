<?php

namespace Reliv\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmUserConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    /*
                     * RcmUser Resource Provider
                     */
                    \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider::class
                    => \Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProviderFactory::class,
                ]
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
        ];
    }
}
