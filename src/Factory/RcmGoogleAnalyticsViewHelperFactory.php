<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\View\Helper\RcmGoogleAnalyticsJsHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

/**
 * Class RcmGoogleAnalyticsViewHelperFactory
 *
 * RcmGoogleAnalyticsViewHelperFactory
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
        $service = $container->get(\Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics::class);

        return new RcmGoogleAnalyticsJsHelper($config['Reliv\RcmGoogleAnalytics'], $service);
    }
}
