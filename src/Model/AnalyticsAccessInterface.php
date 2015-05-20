<?php

namespace Reliv\RcmGoogleAnalytics\Model;

/**
 * Class AnalyticsAccessInterface
 *
 * AnalyticsAccessInterface
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
interface AnalyticsAccessInterface
{
    /**
     * hasAccess
     *
     * @return boolean
     */
    public function hasAccess();
}
