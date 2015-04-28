<?php

namespace Reliv\RcmGoogleAnalytics\View\Helper;

use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
use Zend\View\Helper\AbstractHelper;

/**
 * Class RcmGoogleAnalyticsJsHelper
 *
 * RcmGoogleAnalyticsJs Helper
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
class RcmGoogleAnalyticsJsHelper extends AbstractHelper
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var RcmGoogleAnalytics
     */
    protected $rcmGoogleAnalyticsService;

    /**
     * @param array              $config
     * @param RcmGoogleAnalytics $rcmGoogleAnalyticsService
     */
    public function __construct(
        $config,
        RcmGoogleAnalytics $rcmGoogleAnalyticsService)
    {
        $this->config = $config;
        $this->rcmGoogleAnalyticsService = $rcmGoogleAnalyticsService;
    }

    /**
     * __invoke
     *
     * @return string
     */
    public function __invoke()
    {
        if(!$this->config['use-analytics'])
        {
            return "";
        }

        $template = $this->config['javascript-view'];

        $this->model = $this->rcmGoogleAnalyticsService->getCurrentAnalyticEntity();

        ob_start();
        include($template);
        $output = ob_get_clean();

        return $output;
    }

}