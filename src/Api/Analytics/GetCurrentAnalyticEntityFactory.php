<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentAnalyticEntityFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return GetCurrentAnalyticEntity
     */
    public function __invoke($container)
    {
        return new GetCurrentAnalyticEntity(
            $container->get(GetCurrentSiteId::class),
            $container->get(GetAnalyticEntityForSite::class),
            $container->get('config')
        );
    }
}
