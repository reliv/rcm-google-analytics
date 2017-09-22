<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentAnalyticEntity
{
    protected $getCurrentSiteId;
    protected $getAnalyticEntityForSite;

    /**
     * @param GetCurrentSiteId         $getCurrentSiteId
     * @param GetAnalyticEntityForSite $getAnalyticEntityForSite
     */
    public function __construct(
        GetCurrentSiteId $getCurrentSiteId,
        GetAnalyticEntityForSite $getAnalyticEntityForSite
    ) {
        $this->getCurrentSiteId = $getCurrentSiteId;
        $this->getAnalyticEntityForSite = $getAnalyticEntityForSite;
    }

    /**
     * @param ServerRequestInterface $request
     * @param null                   $default
     *
     * @return null|\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics
     */
    public function __invoke(
        ServerRequestInterface $request,
        $default = null
    ) {
        $siteId = $this->getCurrentSiteId->__invoke($request);

        return $this->getAnalyticEntityForSite->__invoke(
            $siteId,
            $default
        );
    }
}
