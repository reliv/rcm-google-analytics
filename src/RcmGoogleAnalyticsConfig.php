<?php

namespace Reliv\RcmGoogleAnalytics;

use Reliv\RcmGoogleAnalytics\Api\Analytics\GetAnalyticEntityForSite;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetAnalyticEntityForSiteFactory;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntityFactory;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntityWithVerifyCode;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntityWithVerifyCodeFactory;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsConfig
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
             * Dependencies config
             */
            'dependencies' => [
                'factories' => [
                    /**
                     * Api ============================
                     */
                    /**
                     * Set access based on RcmUser Acl Resources
                     * Configured by acl-resource-config config settings
                     * By default will use 'RcmGoogleAnalyticsResourceProvider'
                     *
                     * Over-ride this as needed
                     */
                    \Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed::class
                    => \Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowedRcmUserFactory::class,

                    \Reliv\RcmGoogleAnalytics\Api\Render\RenderAnalyticsJs::class
                    => \Reliv\RcmGoogleAnalytics\Api\Render\RenderAnalyticsJsFactory::class,

                    GetAnalyticEntityForSite::class
                    => GetAnalyticEntityForSiteFactory::class,

                    GetCurrentAnalyticEntity::class
                    => GetCurrentAnalyticEntityFactory::class,

                    GetCurrentAnalyticEntityWithVerifyCode::class
                    => GetCurrentAnalyticEntityWithVerifyCodeFactory::class,

                    /**
                     * Get Site Id from RCM site by default
                     *
                     * Over-ride this as needed
                     */
                    \Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId::class
                    => \Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteIdRcmFactory::class,

                    /**
                     * Get host from RCM siteId by default
                     *
                     * Over-ride this as needed
                     */
                    \Reliv\RcmGoogleAnalytics\Api\Site\GetHost::class
                    => \Reliv\RcmGoogleAnalytics\Api\Site\GetHostRcmFactory::class,

                    \Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsHydrate::class
                    => \Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsHydrateFactory::class,

                    \Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsToArray::class
                    => \Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsToArrayFactory::class,

                    /**
                     * Translate using ZF2 MvcTranslator by default
                     *
                     * Over-ride this as needed
                     */
                    \Reliv\RcmGoogleAnalytics\Api\Translate::class
                    => \Reliv\RcmGoogleAnalytics\Api\TranslateZf2Factory::class,

                    /*
                     * Service
                     */
                    \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics::class
                    => \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalyticsServiceFactory::class,
                ],
            ],

            /**
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
             * Configuration
             */
            'Reliv\RcmGoogleAnalytics' => [
                'use-analytics' => true,
                //Only set TRACKING_ID_OVERRIDE on local/dev/staging. Leave null on prod.
                \Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity::TRACKING_ID_OVERRIDE_KEY => null,
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
        ];
    }
}
