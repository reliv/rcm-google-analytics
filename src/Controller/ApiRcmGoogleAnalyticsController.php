<?php


namespace Reliv\RcmGoogleAnalytics\Controller;

use Rcm\View\Model\ApiJsonModel;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;
use Reliv\RcmGoogleAnalytics\InputFilter\RcmGoogleAnalyticsFilter;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;


/**
 * Class ApiRcmGoogleAnalyticsController
 *
 * ApiRcmGoogleAnalyticsController
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\Controller
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiRcmGoogleAnalyticsController extends AbstractRestfulController
{

    const CURRENT_ID = 'current';
    /**
     * getEntityManager
     *
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    protected function getEntityManager()
    {
        return $this->serviceLocator->get('Doctrine\ORM\EntityManager');
    }

    /**
     * getCurrentSite
     *
     * @return \Rcm\Entity\Site
     */
    protected function getCurrentSite()
    {
        return $this->serviceLocator->get('Rcm\Service\CurrentSite');
    }

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
     * getRcmGoogleAnalyticsService
     *
     * @return \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics
     */
    protected function getRcmGoogleAnalyticsService()
    {
        return $this->getServiceLocator()->get(
            'Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics'
        );
    }

    /**
     * getCurrentUser
     *
     * @return \RcmUser\User\Entity\User
     */
    protected function getCurrentUser()
    {
        return $this->rcmUserGetCurrentUser();
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
     * Create a new resource
     *
     * @param  mixed $data
     *
     * @return mixed
     */
    public function create($data)
    {
        if (!$this->hasAccess()) {

            $this->response->setStatusCode(401);

            return new ApiJsonModel(null, 401, $this->translate('Access Denied'));
        }

        $service = $this->getRcmGoogleAnalyticsService();
        $currentSite = $this->getCurrentSite();
        $entity = $service->getSiteAnalyticEntity($currentSite);

        if (!empty($entity)) {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($entity, 400, $this->translate('Analytics already exist for this site'));
        }

        // INPUT VALIDATE
        $inputFilter = new RcmGoogleAnalyticsFilter();

        $inputFilter->setData($data);

        if(!$inputFilter->isValid())
        {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($data, 400, $this->translate('Analytics data is not valid'), $inputFilter->getMessages());
        }

        $entity = new RcmGoogleAnalytics();

        $entity->populate($inputFilter->getValues(),['id', 'site']);

        $entity->setSite($this->getCurrentSite());

        $entityManager = $this->getEntityManager();

        try {
            $entityManager->persist($entity);
            $entityManager->flush($entity);
        } catch(\Exception $exception) {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($entity, 400, $this->translate('Analytics failed to save') . ': ' . $exception->getMessage());
        }

        return new ApiJsonModel($entity);
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        if ($id !== self::CURRENT_ID) {
            $this->response->setStatusCode(404);
            return $this->response;
        }

        if (!$this->hasAccess()) {

            $this->response->setStatusCode(401);

            return new ApiJsonModel(null, 401, $this->translate('Access Denied'));
        }

        $service = $this->getRcmGoogleAnalyticsService();
        $currentSite = $this->getCurrentSite();

        $entity = $service->getSiteAnalyticEntity($currentSite);

        if (empty($entity)) {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($entity, 400, $this->translate('Analytics do not exist for this site'));
        }

        $entityManager = $this->getEntityManager();

        try {
            $entityManager->remove($entity);
            $entityManager->flush($entity);
        } catch(\Exception $exception) {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($entity, 400, $this->translate('Analytics failed to delete') . ': ' . $exception->getMessage());
        }

        return new ApiJsonModel(null);
    }

    /**
     * Return single resource
     *
     * @param  mixed $id
     *
     * @return mixed
     */
    public function get($id)
    {
        if ($id !== self::CURRENT_ID) {
            $this->response->setStatusCode(404);
            return $this->response;
        }

        if (!$this->hasAccess()) {

            $this->response->setStatusCode(401);

            return new ApiJsonModel(null, 401, $this->translate('Access Denied'));
        }

        $service = $this->getRcmGoogleAnalyticsService();
        $currentSite = $this->getCurrentSite();
        $entity = $service->getSiteAnalyticEntity($currentSite);

        if (empty($entity)) {
            $this->response->setStatusCode(404);
            return new ApiJsonModel($entity, 404, $this->translate('Analytics do not exist for this site'));
        }

        return new ApiJsonModel($entity);
    }

    /**
     * Respond to the PATCH method
     *
     * Not marked as abstract, as that would introduce a BC break
     * (introduced in 2.1.0); instead, raises an exception if not implemented.
     *
     * @param  $id
     * @param  $data
     *
     * @return array
     */
    public function patch($id, $data)
    {
        if ($id !== self::CURRENT_ID) {
            $this->response->setStatusCode(404);
            return $this->response;
        }

        if (!$this->hasAccess()) {

            $this->response->setStatusCode(401);
            return new ApiJsonModel(null, 401, $this->translate('Access Denied'));
        }

        $service = $this->getRcmGoogleAnalyticsService();
        $currentSite = $this->getCurrentSite();

        $entity = $service->getSiteAnalyticEntity($currentSite);

        if (empty($entity)) {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($entity, 400, $this->translate('Analytics do not exist for this site'));
        }

        // INPUT VALIDATE
        $inputFilter = new RcmGoogleAnalyticsFilter();

        $inputFilter->setData($data);

        if(!$inputFilter->isValid())
        {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($data, 400, $this->translate('Analytics data is not valid'), $inputFilter->getMessages());
        }

        $entity->populate($inputFilter->getValues(), ['id', 'site']);

        $entityManager = $this->getEntityManager();

        try {
            $entityManager->persist($entity);
            $entityManager->flush($entity);
        } catch(\Exception $exception) {
            $this->response->setStatusCode(400);
            return new ApiJsonModel($entity, 400, $this->translate('Analytics failed to update') . ': ' . $exception->getMessage());
        }

        return new ApiJsonModel($entity);
    }

}