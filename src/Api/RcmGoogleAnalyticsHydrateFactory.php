<?php

namespace Reliv\RcmGoogleAnalytics\Api;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsHydrateFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalyticsHydrate
     */
    public function __invoke($container)
    {
        return new RcmGoogleAnalyticsHydrate();
    }
}
