<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
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
class RcmGoogleAnalyticsServiceFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalytics
     */
    public function __invoke($container)
    {
        $entityManager = $container->get('Doctrine\ORM\EntityManager');
        $currentSite = $container->get(\Rcm\Service\CurrentSite::class);

        return new RcmGoogleAnalytics($entityManager, $currentSite);
    }
}
