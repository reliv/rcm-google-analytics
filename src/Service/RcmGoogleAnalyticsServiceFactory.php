<?php

namespace Reliv\RcmGoogleAnalytics\Service;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
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
        $entityManager = $container->get(EntityManager::class);
        $currentSite = $container->get(GetCurrentSiteId::class);

        return new RcmGoogleAnalytics($entityManager, $currentSite);
    }
}
