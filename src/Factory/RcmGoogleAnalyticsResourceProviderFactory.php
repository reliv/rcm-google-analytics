<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RcmGoogleAnalyticsResourceProviderFactory
 *
 * RcmGoogleAnalyticsResourceProviderFactory
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
class RcmGoogleAnalyticsResourceProviderFactory implements FactoryInterface
{
    /**
     * create RcmGoogleAnalyticsResourceProvider
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return RcmGoogleAnalyticsResourceProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new RcmGoogleAnalyticsResourceProvider(null);
    }
}
