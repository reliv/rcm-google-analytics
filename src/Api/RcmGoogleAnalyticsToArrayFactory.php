<?php

namespace Reliv\RcmGoogleAnalytics\Api;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Site\GetHost;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsToArrayFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalyticsToArray
     */
    public function __invoke($container)
    {
        return new RcmGoogleAnalyticsToArray(
            $container->get(GetHost::class)
        );
    }
}
