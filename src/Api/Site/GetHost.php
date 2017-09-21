<?php

namespace Reliv\RcmGoogleAnalytics\Api\Site;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface GetHost
{
    /**
     * @param int|string $siteId
     * @param array      $options
     *
     * @return string
     */
    public function __invoke(
        $siteId,
        array $options = []
    );
}
