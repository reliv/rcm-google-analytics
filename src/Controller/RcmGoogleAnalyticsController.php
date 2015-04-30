<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


/**
 * Class RcmGoogleAnalyticsController
 *
 * RcmGoogleAnalyticsController
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
class RcmGoogleAnalyticsController extends AbstractActionController
{
    /**
     * translate
     *
     * @param string $string
     *
     * @return mixed
     */
    protected function translate($string)
    {
        $translator = $this->serviceLocator->get('MvcTranslator');

        return $translator->translate($string);
    }

    /**
     * hasAccess
     *
     * @return mixed
     */
    protected function hasAccess()
    {
        $accessModel = $this->serviceLocator->get(
            'Reliv\RcmGoogleAnalytics\AnalyticsAccess'
        );

        return $accessModel->hasAccess();
    }

    /**
     * indexAction
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        if (!$this->hasAccess()) {

            $this->response->setStatusCode(401);

            return $this->response;
        }

        $translations = [
            "Loading.." => $this->translate("Loading.."),
            "Google Analytics Tracking Id" => $this->translate(
                "Google Analytics Tracking Id"
            ),
            "Submit" => $this->translate("Submit"),
            "Remove" => $this->translate("Remove")
        ];

        return $translations;
    }
}