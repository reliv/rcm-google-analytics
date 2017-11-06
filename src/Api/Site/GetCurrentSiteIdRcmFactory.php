<?php

namespace Reliv\RcmGoogleAnalytics\Api\Site;

use Interop\Container\ContainerInterface;
use Rcm\Api\GetSiteByRequest;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentSiteIdRcmFactory
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
            $container->get(GetSiteByRequest::class)
        );
    }
}
