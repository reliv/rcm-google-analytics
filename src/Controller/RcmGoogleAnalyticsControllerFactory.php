<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsControllerFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalyticsController
     */
    public function __invoke($container)
    {
        return new RcmGoogleAnalyticsController(
            $container->get(Translate::class),
            $container->get(IsAllowed::class)
        );
    }
}
