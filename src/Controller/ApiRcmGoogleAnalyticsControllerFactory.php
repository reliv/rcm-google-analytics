<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsHydrate;
use Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsToArray;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @deprecated ZF2 version
 * @author James Jervis - https://github.com/jerv13
 */
class ApiRcmGoogleAnalyticsControllerFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return ApiRcmGoogleAnalyticsController
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof ControllerManager) {
            $container = $container->getServiceLocator();
        }

        return new ApiRcmGoogleAnalyticsController(
            $container->get(EntityManager::class),
            $container->get(GetCurrentSiteId::class),
            $container->get(Translate::class),
            $container->get(RcmGoogleAnalytics::class),
            $container->get(IsAllowed::class),
            $container->get(RcmGoogleAnalyticsHydrate::class),
            $container->get(RcmGoogleAnalyticsToArray::class)
        );
    }
}
