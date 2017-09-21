<?php

namespace Reliv\RcmGoogleAnalytics\Middleware;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsToArray;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ApiRcmGoogleAnalyticsFindFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return ApiRcmGoogleAnalyticsFind
     */
    public function __invoke($container)
    {
        return new ApiRcmGoogleAnalyticsFind(
            $container->get(EntityManager::class),
            $container->get(GetCurrentSiteId::class),
            $container->get(Translate::class),
            $container->get(RcmGoogleAnalytics::class),
            $container->get(IsAllowed::class),
            $container->get(RcmGoogleAnalyticsToArray::class)
        );
    }
}
