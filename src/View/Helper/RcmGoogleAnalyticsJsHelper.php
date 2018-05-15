<?php

namespace Reliv\RcmGoogleAnalytics\View\Helper;

use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;
use Reliv\RcmGoogleAnalytics\PsrServerRequest;
use Zend\View\Helper\AbstractHelper;

/**
 * @deprecated ZF2 version
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
     * @var GetCurrentAnalyticEntity
     */
    protected $getCurrentAnalyticEntity;

    /**
     * @var object
     */
    protected $model;

    /**
     * __construct
     *
     * @param array $config
     * @param GetCurrentAnalyticEntity $getCurrentAnalyticEntity
     */
    public function __construct(
        $config,
        GetCurrentAnalyticEntity $getCurrentAnalyticEntity
    ) {
        $this->config = $config;
        $this->getCurrentAnalyticEntity = $getCurrentAnalyticEntity;
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

        $default = new RcmGoogleAnalytics();

        $this->model = $this->getCurrentAnalyticEntity->__invoke(
            $psrRequest,
            $default
        );

        return $this->getView()->partial(
            'scriptInclude',
            array('model' => $this->model)
        );
    }
}
