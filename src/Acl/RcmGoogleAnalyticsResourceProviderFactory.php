<?php

namespace Reliv\RcmGoogleAnalytics\Acl;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RcmGoogleAnalyticsResourceProviderFactory
 *
 * RcmGoogleAnalyticsResourceProviderFactory
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsResourceProviderFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return RcmGoogleAnalyticsResourceProvider
     */
    public function __invoke($container)
    {
        return new RcmGoogleAnalyticsResourceProvider(null);
    }
}
