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
        $rcmUserService = $container->get('RcmUser\Service\RcmUserService');
        $config = $container->get('config');

        $resourceConfig = $config['Reliv\RcmGoogleAnalytics']['acl-resource-config'];

        return new AnalyticsAccessRcmUserAcl(
            $rcmUserService,
            $resourceConfig['privilege'],
            $resourceConfig['resourceId'],
            $resourceConfig['providerId']
        );
    }
}
