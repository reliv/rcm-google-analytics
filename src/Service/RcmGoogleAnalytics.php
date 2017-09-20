<?php

namespace Reliv\RcmGoogleAnalytics\Service;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;
use Rcm\Entity\Site;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics as RcmGoogleAnalyticsEntity;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalytics
{
    /**
     * @var EntityManager
     */
    protected $entityManager = null;

    /**
     * @var GetCurrentSiteId
     */
    protected $getCurrentSiteId;

    /**
     * @param EntityManager    $entityManager
     * @param GetCurrentSiteId $getCurrentSiteId
     */
    public function __construct(
        EntityManager $entityManager,
        GetCurrentSiteId $getCurrentSiteId
    ) {
        $this->entityManager = $entityManager;
        $this->getCurrentSiteId = $getCurrentSiteId;
    }

    /**
     * get RcmGoogleAnalytics Repository
     *
     * @return \Doctrine\ORM\EntityRepository|\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(
            \Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics::class
        );
    }

    /**
     * @deprecated
     * Get Analytic Entity for current a site
     *
     * @param Site $site
     * @param null $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getSiteAnalyticEntity(
        Site $site,
        $default = null
    ) {
        return $this->getAnalyticEntityForSite(
            $site->getSiteId(),
            $default
        );
    }

    /**
     * @param      $siteId
     * @param null $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getAnalyticEntityForSite(
        $siteId,
        $default = null
    ) {
        $analytics = $this->getRepository()->findOneBy(
            ['siteId' => $siteId]
        );

        if (!empty($analytics)) {
            return $analytics;
        }

        return $default;
    }

    /**
     * Get Analytic Entity for current site
     *
     * @param ServerRequestInterface $request
     * @param null                   $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getCurrentAnalyticEntity(
        ServerRequestInterface $request,
        $default = null
    ) {
        $siteId = $this->getCurrentSiteId->__invoke($request);

        return $this->getAnalyticEntityForSite(
            $siteId,
            $default
        );
    }

    /**
     * get Current Analytic Entity With VerifyCode
     * This can be used if verification code is needed
     *
     * @param ServerRequestInterface $request
     * @param string                 $verificationCode
     * @param null                   $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getCurrentAnalyticEntityWithVerifyCode(
        ServerRequestInterface $request,
        $verificationCode,
        $default = null
    ) {
        $entity = $this->getCurrentAnalyticEntity(
            $request,
            new RcmGoogleAnalyticsEntity()
        );

        if ($entity->getVerificationCode() !== $verificationCode) {
            return $default;
        }

        return $entity;
    }
}
