<?php

namespace Reliv\RcmGoogleAnalytics\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
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
