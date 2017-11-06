<?php

namespace Reliv\RcmGoogleAnalytics\Service;

use Psr\Http\Message\ServerRequestInterface;
use Rcm\Entity\Site;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetAnalyticEntityForSite;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntityWithVerifyCode;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics as RcmGoogleAnalyticsEntity;

/**
 * @deprecated Use Reliv\RcmGoogleAnalytics\Api\*
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalytics
{
    /**
     * @var GetAnalyticEntityForSite
     */
    protected $getAnalyticEntityForSite;

    /**
     * @var GetCurrentAnalyticEntity
     */
    protected $getCurrentAnalyticEntity;

    /**
     * @var GetCurrentAnalyticEntityWithVerifyCode
     */
    protected $getCurrentAnalyticEntityWithVerifyCode;

    /**
     * @param GetAnalyticEntityForSite               $getAnalyticEntityForSite
     * @param GetCurrentAnalyticEntity               $getCurrentAnalyticEntity
     * @param GetCurrentAnalyticEntityWithVerifyCode $getCurrentAnalyticEntityWithVerifyCode
     */
    public function __construct(
        GetAnalyticEntityForSite $getAnalyticEntityForSite,
        GetCurrentAnalyticEntity $getCurrentAnalyticEntity,
        GetCurrentAnalyticEntityWithVerifyCode $getCurrentAnalyticEntityWithVerifyCode
    ) {
        $this->getAnalyticEntityForSite = $getAnalyticEntityForSite;
        $this->getCurrentAnalyticEntity = $getCurrentAnalyticEntity;
        $this->getCurrentAnalyticEntityWithVerifyCode = $getCurrentAnalyticEntityWithVerifyCode;
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
        return $this->getAnalyticEntityForSite->__invoke(
            $siteId,
            $default
        );
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
        return $this->getCurrentAnalyticEntity->__invoke(
            $request,
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
        return $this->getCurrentAnalyticEntityWithVerifyCode->__invoke(
            $request,
            $verificationCode,
            $default
        );
    }
}
