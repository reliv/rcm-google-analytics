<?php

namespace Reliv\RcmGoogleAnalytics\Api\Acl;

use Interop\Container\ContainerInterface;
use RcmUser\Service\RcmUserService;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class IsAllowedRcmUserFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return IsAllowedRcmUser
     */
    public function __invoke($container)
    {
        return new IsAllowedRcmUser();
    }
}
