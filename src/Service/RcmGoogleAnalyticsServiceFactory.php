<?php

namespace Reliv\RcmGoogleAnalytics\Service;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetAnalyticEntityForSite;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntityWithVerifyCode;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @deprecated
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsServiceFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalytics
     */
    public function __invoke($container)
    {
        return new RcmGoogleAnalytics(
            $container->get(GetAnalyticEntityForSite::class),
            $container->get(GetCurrentAnalyticEntity::class),
            $container->get(GetCurrentAnalyticEntityWithVerifyCode::class)
        );
    }
}
