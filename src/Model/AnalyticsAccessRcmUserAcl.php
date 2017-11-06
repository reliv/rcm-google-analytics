<?php

namespace Reliv\RcmGoogleAnalytics\Model;

/**
 * @deprecated use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed
 *
 * @author James Jervis - https://github.com/jerv13
 */
class AnalyticsAccessRcmUserAcl implements AnalyticsAccessInterface
{
    /**
     * @var \RcmUser\Service\RcmUserService
     */
    protected $rcmUserService;

    /**
     * @var string
     */
    protected $resourceId;

    /**
     * @var string Default is Rcm's default admin role
     */
    protected $privilege;

    /**
     * @var string Default is default provider
     */
    protected $providerId;

    /**
     * __construct
     *
     * @param        $rcmUserService
     * @param string $privilege
     * @param string $resourceId
     * @param string $providerId
     */
    public function __construct(
        $rcmUserService,
        $privilege = "admin",
        $resourceId = "RcmGoogleAnalytics",
        $providerId = 'Reliv\RcmGoogleAnalytics\Acl\ResourceProvider'
    ) {
        $this->rcmUserService = $rcmUserService;
        $this->privilege = $privilege;
        $this->resourceId = $resourceId;
        $this->providerId = $providerId;
    }

    /**
     * has Access
     *
     * @return boolean
     */
    public function hasAccess()
    {
        // no restrictions
        return $this->rcmUserService->isAllowed(
            $this->resourceId,
            $this->privilege,
            $this->providerId
        );
    }
}
