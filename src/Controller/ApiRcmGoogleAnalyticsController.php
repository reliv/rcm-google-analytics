<?php

namespace Reliv\RcmGoogleAnalytics\Controller;

use Doctrine\ORM\EntityManager;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsHydrate;
use Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsToArray;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;
use Reliv\RcmGoogleAnalytics\InputFilter\RcmGoogleAnalyticsFilter;
use Reliv\RcmGoogleAnalytics\PsrServerRequest;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics as RcmGoogleAnalyticsService;
use Reliv\RcmGoogleAnalytics\View\Model\ApiJsonModel;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Stdlib\ResponseInterface;

/**
 * @deprecated ZF2 version
 * @author James Jervis - https://github.com/jerv13
 */
class ApiRcmGoogleAnalyticsController extends AbstractRestfulController
{
    const CURRENT_ID = 'current';

    protected $entityManager;
    protected $getCurrentSiteId;
    protected $translate;
    protected $rcmGoogleAnalyticsService;
    protected $isAllowed;
    protected $rcmGoogleAnalyticsHydrate;
    protected $rcmGoogleAnalyticsToArray;

    /**
     * @param EntityManager             $entityManager
     * @param GetCurrentSiteId          $getCurrentSiteId
     * @param Translate                 $translate
     * @param RcmGoogleAnalyticsService $rcmGoogleAnalyticsService
     * @param IsAllowed                 $isAllowed
     * @param RcmGoogleAnalyticsHydrate $rcmGoogleAnalyticsHydrate
     * @param RcmGoogleAnalyticsToArray $rcmGoogleAnalyticsToArray
     */
    public function __construct(
        EntityManager $entityManager,
        GetCurrentSiteId $getCurrentSiteId,
        Translate $translate,
        RcmGoogleAnalyticsService $rcmGoogleAnalyticsService,
        IsAllowed $isAllowed,
        RcmGoogleAnalyticsHydrate $rcmGoogleAnalyticsHydrate,
        RcmGoogleAnalyticsToArray $rcmGoogleAnalyticsToArray
    ) {
        $this->entityManager = $entityManager;
        $this->getCurrentSiteId = $getCurrentSiteId;
        $this->translate = $translate;
        $this->rcmGoogleAnalyticsService = $rcmGoogleAnalyticsService;
        $this->isAllowed = $isAllowed;
        $this->rcmGoogleAnalyticsHydrate = $rcmGoogleAnalyticsHydrate;
        $this->rcmGoogleAnalyticsToArray = $rcmGoogleAnalyticsToArray;
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
        $request = PsrServerRequest::get();

        if (!$this->isAllowed->__invoke($request)) {
            $this->response->setStatusCode(401);

            return new ApiJsonModel(
                null,
                401,
                $this->translate->__invoke('Access Denied')
            );
        }

        $service = $this->rcmGoogleAnalyticsService;
        $currentSiteId = $this->getCurrentSiteId->__invoke($request);
        $entity = $service->getAnalyticEntityForSite($currentSiteId);

        if (!empty($entity)) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $this->rcmGoogleAnalyticsToArray->__invoke($entity),
                400,
                $this->translate->__invoke('Analytics already exist for this site')
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
                $this->translate->__invoke('Analytics data is not valid'),
                $inputFilter->getMessages()
            );
        }

        $entity = new RcmGoogleAnalytics();

        $entity = $this->rcmGoogleAnalyticsHydrate->__invoke(
            $entity,
            $inputFilter->getValues()
        );

        $entity->setSiteId($currentSiteId);

        $entityManager = $this->entityManager;

        try {
            $entityManager->persist($entity);
            $entityManager->flush($entity);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $this->rcmGoogleAnalyticsToArray->__invoke($entity),
                400,
                $this->translate->__invoke('Analytics failed to save') . ': ' . $exception->getMessage()
            );
        }

        return new ApiJsonModel(
            $this->rcmGoogleAnalyticsToArray->__invoke($entity)
        );
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
        $request = PsrServerRequest::get();

        if ($id !== self::CURRENT_ID) {
            $this->response->setStatusCode(404);

            return $this->response;
        }

        if (!$this->isAllowed->__invoke($request)) {
            $this->response->setStatusCode(401);

            return new ApiJsonModel(
                null,
                401,
                $this->translate->__invoke('Access Denied')
            );
        }

        $service = $this->rcmGoogleAnalyticsService;
        $currentSiteId = $this->getCurrentSiteId->__invoke($request);

        $entity = $service->getAnalyticEntityForSite($currentSiteId);

        if (empty($entity)) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                null,
                400,
                $this->translate->__invoke('Analytics do not exist for this site')
            );
        }

        $entityManager = $this->entityManager;

        try {
            $entityManager->remove($entity);
            $entityManager->flush($entity);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $this->rcmGoogleAnalyticsToArray->__invoke($entity),
                400,
                $this->translate->__invoke('Analytics failed to delete') . ': ' . $exception->getMessage()
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
        $request = PsrServerRequest::get();

        if ($id !== self::CURRENT_ID) {
            $this->response->setStatusCode(404);

            return $this->response;
        }

        if (!$this->isAllowed->__invoke($request)) {
            $this->response->setStatusCode(401);

            return new ApiJsonModel(
                null,
                401,
                $this->translate->__invoke('Access Denied')
            );
        }

        $service = $this->rcmGoogleAnalyticsService;
        $currentSiteId = $this->getCurrentSiteId->__invoke($request);
        $entity = $service->getAnalyticEntityForSite($currentSiteId);

        if (empty($entity)) {
            $this->response->setStatusCode(404);

            return new ApiJsonModel(
                null,
                404,
                $this->translate->__invoke('Analytics do not exist for this site')
            );
        }

        return new ApiJsonModel(
            $this->rcmGoogleAnalyticsToArray->__invoke($entity)
        );
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
        $request = PsrServerRequest::get();

        if ($id !== self::CURRENT_ID) {
            $this->response->setStatusCode(404);

            return $this->response;
        }

        if (!$this->isAllowed->__invoke($request)) {
            $this->response->setStatusCode(401);

            return new ApiJsonModel(
                null,
                401,
                $this->translate->__invoke('Access Denied')
            );
        }

        $service = $this->rcmGoogleAnalyticsService;
        $currentSiteId = $this->getCurrentSiteId->__invoke($request);

        $entity = $service->getAnalyticEntityForSite($currentSiteId);

        if (empty($entity)) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                null,
                400,
                $this->translate->__invoke('Analytics do not exist for this site')
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
                $this->translate->__invoke('Analytics data is not valid'),
                $inputFilter->getMessages()
            );
        }

        $entity = $this->rcmGoogleAnalyticsHydrate->__invoke(
            $entity,
            $inputFilter->getValues()
        );

        $entityManager = $this->entityManager;

        try {
            $entityManager->persist($entity);
            $entityManager->flush($entity);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(400);

            return new ApiJsonModel(
                $this->rcmGoogleAnalyticsToArray->__invoke($entity),
                400,
                $this->translate->__invoke('Analytics failed to update') . ': ' . $exception->getMessage()
            );
        }

        return new ApiJsonModel(
            $this->rcmGoogleAnalyticsToArray->__invoke($entity)
        );
    }
}
