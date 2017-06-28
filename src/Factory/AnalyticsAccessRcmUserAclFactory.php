<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Model\AnalyticsAccessRcmUserAcl;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AnalyticsAccessRcmUserAclFactory
 *
 * AnalyticsAccessRcmUserAclFactory
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
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
