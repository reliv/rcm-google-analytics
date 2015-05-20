<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Reliv\RcmGoogleAnalytics\Model\AnalyticsAccessRcmUserAcl;
use Zend\ServiceManager\FactoryInterface;
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
class AnalyticsAccessRcmUserAclFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $rcmUserService = $serviceLocator->get('RcmUser\Service\RcmUserService');
        $config = $serviceLocator->get('config');

        $resourceConfig = $config['Reliv\RcmGoogleAnalytics']['acl-resource-config'];

        return new AnalyticsAccessRcmUserAcl(
            $rcmUserService,
            $resourceConfig['privilege'],
            $resourceConfig['resourceId'],
            $resourceConfig['providerId']
        );
    }
}
