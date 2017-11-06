<?php

namespace Reliv\RcmGoogleAnalytics\Api\Render;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RenderAnalyticsJsFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RenderAnalyticsJs
     */
    public function __invoke($container)
    {
        $config = $container->get('config');

        $config = $config['Reliv\RcmGoogleAnalytics'];

        return new RenderAnalyticsJs(
            $config,
            $container->get(GetCurrentAnalyticEntity::class)
        );
    }
}
