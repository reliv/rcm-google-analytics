<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @deprecated ZF2 version
 * @author James Jervis - https://github.com/jerv13
 */
class VerificationControllerFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return VerificationController
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof ControllerManager) {
            $container = $container->getServiceLocator();
        }

        return new VerificationController(
            $container->get(RcmGoogleAnalytics::class)
        );
    }
}
