<?php

namespace Reliv\RcmGoogleAnalytics\View\Helper;

use Reliv\RcmGoogleAnalytics\PsrServerRequest;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics;
use Zend\Diactoros\ServerRequestFactory;
use Zend\View\Helper\AbstractHelper;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsJsHelper extends AbstractHelper
{
    protected $templatePath = '/../../../view/';
    /**
     * @var array
     */
    protected $config;

    /**
     * @var RcmGoogleAnalytics
     */
    protected $rcmGoogleAnalyticsService;

    /**
     * @var object
     */
    protected $model;

    /**
     * __construct
     * @param array              $config
     * @param RcmGoogleAnalytics $rcmGoogleAnalyticsService
     */
    public function __construct(
        $config,
        RcmGoogleAnalytics $rcmGoogleAnalyticsService
    ) {
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
        if (!$this->config['use-analytics']) {
            return "";
        };

        $psrRequest = PsrServerRequest::get();

        $this->model = $this->rcmGoogleAnalyticsService->getCurrentAnalyticEntity(
            $psrRequest,
            new \Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics()
        );

        return $this->getView()->partial(
            $this->config['javascript-view'],
            array('model' => $this->model)
        );
    }
}
