<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetAnalyticEntityForSiteFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return GetAnalyticEntityForSite
     */
    public function __invoke($container)
    {
        return new GetAnalyticEntityForSite(
            $container->get(EntityManager::class)
        );
    }
}
