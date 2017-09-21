<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;
use Reliv\RcmGoogleAnalytics\PsrServerRequest;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics as RcmGoogleAnalyticsService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * @deprecated ZF2 version
 * @author James Jervis - https://github.com/jerv13
 */
class VerificationController extends AbstractActionController
{
    protected $rcmGoogleAnalyticsService;

    /**
     * @param RcmGoogleAnalyticsService $rcmGoogleAnalyticsService
     */
    public function __construct(
        RcmGoogleAnalyticsService $rcmGoogleAnalyticsService
    ) {
        $this->rcmGoogleAnalyticsService = $rcmGoogleAnalyticsService;
    }

    /**
     * get Verification Code From Route Match
     *
     * @return mixed
     */
    protected function getVerificationCodeFromRoute()
    {
        return $this->getEvent()->getRouteMatch()->getParam('verificationCode');
    }

    /**
     * indexAction
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $requestVerificationCode = $this->getVerificationCodeFromRoute();

        $request = PsrServerRequest::get();

        $model = $this->rcmGoogleAnalyticsService
            ->getCurrentAnalyticEntityWithVerifyCode(
                $request,
                $requestVerificationCode,
                new RcmGoogleAnalytics()
            );

        $verificationCode = $model->getVerificationCode();

        if (empty($verificationCode)) {
            $response = $this->getResponse();
            $response->setStatusCode(404);

            return $response;
        }

        $view = new ViewModel(['model' => $model]);

        $view->setTerminal(true);

        return $view;
    }
}
