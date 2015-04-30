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

        return [];
    }
}