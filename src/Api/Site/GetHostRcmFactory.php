<?php

namespace Reliv\RcmGoogleAnalytics\Api\Site;

use Interop\Container\ContainerInterface;
use Rcm\Api\Repository\Site\FindSite;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetHostRcmFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return GetCurrentSiteIdRcm
     */
    public function __invoke($container)
    {
        return new GetCurrentSiteIdRcm(
            $container->get(FindSite::class)
        );
    }
}
