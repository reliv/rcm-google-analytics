<?php

namespace Reliv\RcmGoogleAnalytics\Api\Site;

use Psr\Http\Message\ServerRequestInterface;
use Rcm\Api\GetSiteByRequest;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentSiteIdRcm implements GetCurrentSiteId
{
    /**
     * @var GetSiteByRequest
     */
    protected $getSiteByRequest;

    /**
     * @param GetSiteByRequest $getSiteByRequest
     */
    public function __construct(
        GetSiteByRequest $getSiteByRequest
    ) {
        $this->getSiteByRequest = $getSiteByRequest;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return int|string
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ) {
        $currentSite = $this->getSiteByRequest->__invoke(
            $request
        );

        return $currentSite->getSiteId();
    }
}
