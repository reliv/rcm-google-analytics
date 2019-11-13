<?php

namespace Reliv\RcmGoogleAnalytics\Model;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @deprecated
 *
 * @author James Jervis - https://github.com/jerv13
 */
class AnalyticsAccessRcmUserAclFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return AnalyticsAccessRcmUserAcl
     */
    public function __invoke($container)
    {
        return new AnalyticsAccessRcmUserAcl();
    }
}
