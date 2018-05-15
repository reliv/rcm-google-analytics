<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Api\Site\GetCurrentSiteId;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentAnalyticEntity
{
    const TRACKING_ID_OVERRIDE_KEY = 'tracking_id_override';

    protected $getCurrentSiteId;
    protected $getAnalyticEntityForSite;
    protected $config;

    /**
     * @param GetCurrentSiteId $getCurrentSiteId
     * @param GetAnalyticEntityForSite $getAnalyticEntityForSite
     */
    public function __construct(
        GetCurrentSiteId $getCurrentSiteId,
        GetAnalyticEntityForSite $getAnalyticEntityForSite,
        $config
    ) {
        $this->getCurrentSiteId = $getCurrentSiteId;
        $this->getAnalyticEntityForSite = $getAnalyticEntityForSite;
        $this->config = $config['Reliv\RcmGoogleAnalytics'];
    }

    /**
     * @param ServerRequestInterface $request
     * @param null $default
     *
     * @return null|\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics
     */
    public
    function __invoke(
        ServerRequestInterface $request,
        $default = null
    ) {
        $siteId = $this->getCurrentSiteId->__invoke($request);

        $entity = $this->getAnalyticEntityForSite->__invoke(
            $siteId,
            $default
        );

        if (!empty($this->config[self::TRACKING_ID_OVERRIDE_KEY])) {
            /**
             * Allow the ID to be overriden in config. Is useful for development environments
             * to keep events from going to the real account id.
             */
            $entity->setTrackingId($this->config[self::TRACKING_ID_OVERRIDE_KEY]);
        }

        return $entity;
    }
}
