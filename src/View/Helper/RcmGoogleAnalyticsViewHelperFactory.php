<?php

namespace Reliv\RcmGoogleAnalytics\View\Helper;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

/**
 * @deprecated ZF2 version
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsViewHelperFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface|HelperPluginManager
     *
     * @return RcmGoogleAnalyticsJsHelper
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof HelperPluginManager) {
            $container = $container->getServiceLocator();
        }

        $config = $container->get('config');

        return new RcmGoogleAnalyticsJsHelper(
            $config['Reliv\RcmGoogleAnalytics'],
            $container->get(GetCurrentAnalyticEntity::class)
        );
    }
}
