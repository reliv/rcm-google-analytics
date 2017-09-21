<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
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
        return new VerificationController(
            $container->get(RcmGoogleAnalytics::class)
        );
    }
}
