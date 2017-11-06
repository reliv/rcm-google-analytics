<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Reliv\RcmGoogleAnalytics\PsrServerRequest;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * @deprecated ZF2 version
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsController extends AbstractActionController
{
    protected $translate;
    protected $isAllowed;

    /**
     * @param Translate $translate
     * @param IsAllowed $isAllowed
     */
    public function __construct(
        Translate $translate,
        IsAllowed $isAllowed
    ) {
        $this->translate = $translate;
        $this->isAllowed = $isAllowed;
    }

    /**
     * index Action
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $request = PsrServerRequest::get();

        if (!$this->isAllowed->__invoke($request)) {
            $this->response->setStatusCode(401);

            // @todo why not returning?
            //return $this->response;
        }

        return new ViewModel(['title' => $this->translate->__invoke("Google Analytics Settings")]);
    }
}
