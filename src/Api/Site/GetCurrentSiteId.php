<?php

namespace Reliv\RcmGoogleAnalytics\Api\Site;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface GetCurrentSiteId
{
    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return int|string
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    );
}
