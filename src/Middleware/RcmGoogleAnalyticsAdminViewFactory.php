<?php

namespace Reliv\RcmGoogleAnalytics\Middleware;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsAdminViewFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalyticsAdminView
     */
    public function __invoke($container)
    {
        return new RcmGoogleAnalyticsAdminView(
            $container->get(Translate::class),
            $container->get(IsAllowed::class)
        );
    }
}
