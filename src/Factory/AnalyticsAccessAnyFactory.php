<?php

namespace Reliv\RcmGoogleAnalytics\Factory;

use Interop\Container\ContainerInterface;
use Reliv\RcmGoogleAnalytics\Model\AnalyticsAccessAny;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AnalyticAccessAnyFactory
 *
 * AnalyticAccessAnyFactory
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
class AnalyticsAccessAnyFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface
     *
     * @return AnalyticsAccessAny
     */
    public function __invoke($container)
    {
        return new AnalyticsAccessAny();
    }
}
