<?php

namespace Reliv\RcmGoogleAnalytics\Middleware;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\RcmGoogleAnalyticsToArray;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics as RcmGoogleAnalyticsService;
use Zend\Diactoros\Response\JsonResponse;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ApiRcmGoogleAnalyticsFind
{
    protected $entityManager;
    protected $getCurrentSiteId;
    protected $translate;
    protected $rcmGoogleAnalyticsService;
    protected $isAllowed;
    protected $rcmGoogleAnalyticsToArray;

    /**
     * @param EntityManager             $entityManager
     * @param GetCurrentSiteId          $getCurrentSiteId
     * @param Translate                 $translate
     * @param RcmGoogleAnalyticsService $rcmGoogleAnalyticsService
     * @param IsAllowed                 $isAllowed
     * @param RcmGoogleAnalyticsToArray $rcmGoogleAnalyticsToArray
     */
    public function __construct(
        EntityManager $entityManager,
        GetCurrentSiteId $getCurrentSiteId,
        Translate $translate,
        RcmGoogleAnalyticsService $rcmGoogleAnalyticsService,
        IsAllowed $isAllowed,
        RcmGoogleAnalyticsToArray $rcmGoogleAnalyticsToArray
    ) {
        $this->entityManager = $entityManager;
        $this->getCurrentSiteId = $getCurrentSiteId;
        $this->translate = $translate;
        $this->rcmGoogleAnalyticsService = $rcmGoogleAnalyticsService;
        $this->isAllowed = $isAllowed;
        $this->rcmGoogleAnalyticsToArray = $rcmGoogleAnalyticsToArray;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface|JsonResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        if (!$this->isAllowed->__invoke($request)) {
            return new JsonResponse(
                [
                    'data' => null,
                    'code' => 401,
                    'message' => $this->translate->__invoke('Access Denied'),
                    'errors' => [],
                ],
                401
            );
        }

        $service = $this->rcmGoogleAnalyticsService;
        $currentSiteId = $this->getCurrentSiteId->__invoke($request);
        $entity = $service->getAnalyticEntityForSite($currentSiteId);

        if (empty($entity)) {
            return new JsonResponse(
                [
                    'data' => null,
                    'code' => 404,
                    'message' => $this->translate->__invoke('Analytics do not exist for this site'),
                    'errors' => [],
                ],
                404
            );
        }

        return new JsonResponse(
            [
                'data' => $this->rcmGoogleAnalyticsToArray->__invoke($entity),
                'code' => 200,
                'message' => '',
                'errors' => [],
            ],
            200
        );
    }
}
