<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $currentSite = $serviceLocator->get('Rcm\Service\CurrentSite');

        return new RcmGoogleAnalytics($entityManager, $currentSite);
    }
}