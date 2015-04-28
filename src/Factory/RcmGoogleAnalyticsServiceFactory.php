<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Reliv\RcmGoogleAnalytics\View\Helper\RcmGoogleAnalyticsJsHelper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RcmGoogleAnalyticsServiceFactory
 *
 * RcmGoogleAnalyticsServiceFactory
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
class RcmGoogleAnalyticsServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $service = $serviceLocator->get('Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics');

        return new RcmGoogleAnalyticsJsHelper($config['Reliv\RcmGoogleAnalytics'], $service);
    }
}