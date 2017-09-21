<?php

namespace Reliv\RcmGoogleAnalytics\Api;

use Reliv\RcmGoogleAnalytics\Api\Site\GetHost;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsToArray
{
    /**
     * @var GetHost
     */
    protected $getHost;

    /**
     * @param GetHost $getHost
     */
    public function __construct(
        GetHost $getHost
    ) {
        $this->getHost = $getHost;
    }

    /**
     * @param RcmGoogleAnalytics $rcmGoogleAnalytics
     * @param array              $options
     *
     * @return array
     */
    public function __invoke(
        RcmGoogleAnalytics $rcmGoogleAnalytics,
        array $options = []
    ): array {
        return [
            'id' => $rcmGoogleAnalytics->getId(),
            'trackingId' => $rcmGoogleAnalytics->getTrackingId(),
            'verificationCode' => $rcmGoogleAnalytics->getVerificationCode(),
            'siteId' => $rcmGoogleAnalytics->getSiteId(),
            // BC SUPPORT FOR CLIENT
            'host' => $this->getHost->__invoke($rcmGoogleAnalytics->getSiteId())
        ];
    }
}
