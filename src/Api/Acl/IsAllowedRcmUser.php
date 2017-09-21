<?php

namespace Reliv\RcmGoogleAnalytics\Api\Acl;

use Psr\Http\Message\ServerRequestInterface;
use RcmUser\Service\RcmUserService;
use Reliv\RcmGoogleAnalytics\Acl\RcmGoogleAnalyticsResourceProvider;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class IsAllowedRcmUser implements IsAllowed
{
    /**
     * @var RcmUserService
     */
    protected $rcmUserService;

    /**
     * @var string
     */
    protected $privilege;

    /**
     * @var string
     */
    protected $resourceId;

    /**
     * @param RcmUserService $rcmUserService
     * @param string         $resourceId
     * @param string         $privilege
     */
    public function __construct(
        RcmUserService $rcmUserService,
        $resourceId = RcmGoogleAnalyticsResourceProvider::RESOURCE_ID,
        $privilege = RcmGoogleAnalyticsResourceProvider::PRIVILEGE_ADMIN
    ) {
        $this->rcmUserService = $rcmUserService;
        $this->resourceId = $resourceId;
        $this->privilege = $privilege;

    }

    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return bool
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ): bool
    {
        return $this->rcmUserService->isAllowed(
            $this->resourceId,
            $this->privilege
        );
    }
}
