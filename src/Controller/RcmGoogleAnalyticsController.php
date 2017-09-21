<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Reliv\RcmGoogleAnalytics\PsrServerRequest;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
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

        $translations = [
            "Loading.." => $this->translate->__invoke("Loading.."),
            "Google Analytics Tracking Id" => $this->translate->__invoke(
                "Google Analytics Tracking Id"
            ),
            "Submit" => $this->translate->__invoke("Submit"),
            "Remove" => $this->translate->__invoke("Remove")
        ];

        return new ViewModel($translations);
    }
}
