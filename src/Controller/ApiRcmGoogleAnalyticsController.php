<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Rcm\View\Model\ApiJsonModel;
use RcmUser\Service\RcmUserService;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;
use Reliv\RcmGoogleAnalytics\InputFilter\RcmGoogleAnalyticsFilter;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Stdlib\ResponseInterface;

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
     * get EntityManager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->serviceLocator->get('Doctrine\ORM\EntityManager');
    }

    /**
     * get CurrentSite
     *
     * @return \Rcm\Entity\Site
     */
    protected function getCurrentSite()
    {
        return $this->serviceLocator->get(\Rcm\Service\CurrentSite::class);
    }

    /**
     * translate using MVC translator
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
     * get RcmGoogleAnalyticsService
     *
     * @return \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics
     */
    protected function getRcmGoogleAnalyticsService()
    {
        return $this->getServiceLocator()->get(
            \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics::class
        );
    }

    /**
     * hasAccess - Use Analytics Access to check access
     *
     * @return mixed
     */
    protected function hasAccess()
    {
        $accessModel = $this->serviceLocator->get(
            \Reliv\RcmGoogleAnalytics\Service\AnalyticsAccess::class
        );

        return $accessModel->hasAccess();
    }

    /**
     * Create a new resource
     *
     * @param  mixed $data
     *
     * @return ResponseInterface|Response|ApiJsonModel
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

            return new ApiJsonModel(
                $entity->toArray(), 400,
                $this->translate('Analytics already exist for this site')
            );
        }

        // INPUT VALIDATE
        $inputFilter = new RcmGoogleAnalyticsFilter();

        $inputFilter->setData($data);

        if (!$inputFilter->isValid()) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $data,
                400,
                $this->translate('Analytics data is not valid'),
                $inputFilter->getMessages()
            );
        }

        $entity = new RcmGoogleAnalytics();

        $entity->populate($inputFilter->getValues(), ['id', 'site']);

        $entity->setSite($this->getCurrentSite());

        $entityManager = $this->getEntityManager();

        try {
            $entityManager->persist($entity);
            $entityManager->flush($entity);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $entity->toArray(),
                400,
                $this->translate('Analytics failed to save') . ': ' . $exception->getMessage()
            );
        }

        return new ApiJsonModel($entity->toArray());
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     *
     * @return ResponseInterface|Response|ApiJsonModel
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

            return new ApiJsonModel(null, 400, $this->translate('Analytics do not exist for this site'));
        }

        $entityManager = $this->getEntityManager();

        try {
            $entityManager->remove($entity);
            $entityManager->flush($entity);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $entity->toArray(),
                400,
                $this->translate('Analytics failed to delete') . ': ' . $exception->getMessage()
            );
        }

        return new ApiJsonModel(null);
    }

    /**
     * Return single resource
     *
     * @param  mixed $id
     *
     * @return ResponseInterface|Response|ApiJsonModel
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

            return new ApiJsonModel(null, 404, $this->translate('Analytics do not exist for this site'));
        }

        return new ApiJsonModel($entity->toArray());
    }

    /**
     * Respond to the PATCH method
     *
     * @param  $id
     * @param  $data
     *
     * @return ResponseInterface|Response|ApiJsonModel
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

            return new ApiJsonModel(null, 400, $this->translate('Analytics do not exist for this site'));
        }

        // INPUT VALIDATE
        $inputFilter = new RcmGoogleAnalyticsFilter();

        $inputFilter->setData($data);

        if (!$inputFilter->isValid()) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $data,
                400,
                $this->translate('Analytics data is not valid'),
                $inputFilter->getMessages()
            );
        }

        $entity->populate($inputFilter->getValues(), ['id', 'site']);

        $entityManager = $this->getEntityManager();

        try {
            $entityManager->persist($entity);
            $entityManager->flush($entity);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $entity->toArray(),
                400,
                $this->translate('Analytics failed to update') . ': ' . $exception->getMessage()
            );
        }

        return new ApiJsonModel($entity->toArray());
    }
}
