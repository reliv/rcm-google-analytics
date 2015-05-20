<?php

namespace Reliv\RcmGoogleAnalytics\Acl;

use RcmUser\Acl\Entity\AclResource;
use RcmUser\Acl\Provider\ResourceProvider;

/**
 * Class RcmGoogleAnalyticsResourceProvider
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\Acl
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsResourceProvider extends ResourceProvider
{
    /**
     * @var string PROVIDER_ID This needs to be the same as the config
     */
    const PROVIDER_ID = 'Reliv\RcmGoogleAnalytics\Acl\ResourceProvider';

    /**
     * @var string RESOURCE_ID_ROOT
     */
    const RESOURCE_ID = 'rcm-google-analytics';

    /**
     * default resources  - rcm user needs these,
     * however descriptions added on construct in the factory
     *
     * @var array $rcmResources
     */
    protected $resources = [];

    /**
     * getResources (ALL resources)
     * Return a multi-dimensional array of resources and privileges
     * containing ALL possible resources including run-time resources
     *
     * @return array
     */
    public function getResources()
    {
        if (empty($this->resources)) {
            $this->buildResources();
        }

        return $this->resources;
    }

    /**
     * getResource
     * Return the requested resource
     * Can be used to return resources dynamically.
     *
     * @param string $resourceId resourceId
     *
     * @return array
     * @throws \RcmUser\Exception\RcmUserException
     */
    public function getResource($resourceId)
    {

        if (empty($this->resources)) {
            $this->buildResources();
        }

        return parent::getResource($resourceId);
    }

    /**
     * buildResources - build static resources
     *
     * @return void
     */
    protected function buildResources()
    {
        $privileges = [
            'admin'
        ];

        /* root resource */
        $this->resources[self::RESOURCE_ID]
            = new AclResource(self::RESOURCE_ID);
        $this->resources[self::RESOURCE_ID]->setName(
            'Rcm Google Analytics'
        );
        $this->resources[self::RESOURCE_ID]->setDescription(
            'All Rcm Google Analytics access.'
        );
        $this->resources[self::RESOURCE_ID]->setPrivileges(
            $privileges
        );
    }
}
