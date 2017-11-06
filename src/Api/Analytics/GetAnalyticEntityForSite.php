<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Doctrine\ORM\EntityManager;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetAnalyticEntityForSite
{
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            RcmGoogleAnalytics::class
        );
    }

    /**
     * @param string|int $siteId
     * @param null       $default
     *
     * @return null|RcmGoogleAnalytics
     */
    public function __invoke(
        $siteId,
        $default = null
    ) {
        $analytics = $this->repository->findOneBy(
            ['siteId' => $siteId]
        );

        if (!empty($analytics)) {
            return $analytics;
        }

        return $default;
    }
}
