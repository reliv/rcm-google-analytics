<?php

namespace Reliv\RcmGoogleAnalytics\Api\Site;

use Rcm\Api\Repository\Site\FindSite;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetHostRcm implements GetHost
{
    protected $findSite;

    /**
     * @param FindSite $findSite
     */
    public function __construct(
        FindSite $findSite
    ) {
        $this->findSite = $findSite;
    }

    /**
     * @param int|string $siteId
     * @param array      $options
     *
     * @return string
     */
    public function __invoke(
        $siteId,
        array $options = []
    ) {
        $site = $this->findSite->__invoke($siteId);

        if (empty($site)) {
            return null;
        }

        return $site->getDomainName();
    }
}
