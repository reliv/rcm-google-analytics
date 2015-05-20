<?php

namespace Reliv\RcmGoogleAnalytics\Model;

/**
 * Class AnalyticsAccessRcmUserAcl
 *
 * AnalyticsAccessRcmUserAcl
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
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
     * hasAccess
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
