<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentAnalyticEntityWithVerifyCodeFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return GetCurrentAnalyticEntityWithVerifyCode
     */
    public function __invoke($container)
    {
        return new GetCurrentAnalyticEntityWithVerifyCode(
            $container->get(GetCurrentAnalyticEntity::class)
        );
    }
}
