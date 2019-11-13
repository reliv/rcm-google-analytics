<?php

namespace Reliv\RcmGoogleAnalytics\Api\Acl;

use Psr\Http\Message\ServerRequestInterface;
use RcmUser\Service\RcmUserService;
use Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider;

class IsAllowedRcmUser implements IsAllowed
{
    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return bool
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ): bool {
        return false; //This was disabled durring the ACL2 project because it doesn't follow new rules.
    }
}
