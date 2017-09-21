<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @deprecated ZF2 version
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsControllerFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalyticsController
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof ControllerManager) {
            $container = $container->getServiceLocator();
        }

        return new RcmGoogleAnalyticsController(
            $container->get(Translate::class),
            $container->get(IsAllowed::class)
        );
    }
}
