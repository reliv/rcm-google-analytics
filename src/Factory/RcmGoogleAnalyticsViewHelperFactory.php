<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Reliv\RcmGoogleAnalytics\View\Helper\RcmGoogleAnalyticsJsHelper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RcmGoogleAnalyticsViewHelperFactory
 *
 * RcmGoogleAnalyticsViewHelperFactory
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
class RcmGoogleAnalyticsViewHelperFactory implements FactoryInterface
{
    /**
     * create RcmGoogleAnalyticsJsHelper
     *
     * @param ServiceLocatorInterface $manager
     *
     * @return RcmGoogleAnalyticsJsHelper
     */
    public function createService(ServiceLocatorInterface $manager)
    {
        $serviceLocator = $manager->getServiceLocator();

        $config = $serviceLocator->get('config');
        $service = $serviceLocator->get('Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics');

        return new RcmGoogleAnalyticsJsHelper($config['Reliv\RcmGoogleAnalytics'], $service);
    }
}
