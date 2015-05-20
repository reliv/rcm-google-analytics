<?php

namespace Reliv\RcmGoogleAnalytics\Service;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Site;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics as RcmGoogleAnalyticsEntity;

/**
 * Class RcmGoogleAnalytics
 *
 * RcmGoogleAnalytics Service
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
class RcmGoogleAnalytics
{
    /**
     * @var EntityManager
     */
    protected $entityManager = null;

    /**
     * @var Site|null
     */
    protected $currentSite = null;

    /**
     * @param EntityManager    $entityManager
     * @param Site $currentSite
     */
    public function __construct(
        EntityManager $entityManager,
        Site $currentSite
    ) {
        $this->entityManager = $entityManager;
        $this->currentSite = $currentSite;
    }

    /**
     * getEntityManager
     *
     * @return EntityManager|null
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * getRepository
     *
     * @return \Doctrine\ORM\EntityRepository|\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(
            '\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics'
        );
    }

    /**
     * getCurrentSite
     *
     * @return null|\Rcm\Entity\Site
     */
    protected function getCurrentSite()
    {
        return $this->currentSite;
    }

    /**
     * getSiteAnalyticEntity
     *
     * @param Site $site
     * @param null $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getSiteAnalyticEntity(Site $site, $default = null)
    {
        $analytics = $this->getRepository()->findOneBy(['site' => $site]);

        if (!empty($analytics)) {
            return $analytics;
        }

        return $default;
    }

    /**
     * getCurrentAnalyticEntity
     *
     * @param null $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getCurrentAnalyticEntity($default = null)
    {
        $site = $this->getCurrentSite();

        if (empty($site)) {
            return $default;
        }

        return $this->getSiteAnalyticEntity($site, $default);
    }

    /**
     * getCurrentAnalyticEntityWithVerifyCode
     *
     * @param string $verificationCode
     * @param null $default
     *
     * @return null|RcmGoogleAnalyticsEntity
     */
    public function getCurrentAnalyticEntityWithVerifyCode($verificationCode, $default = null)
    {
        $entity = $this->getCurrentAnalyticEntity(new RcmGoogleAnalyticsEntity());

        if ($entity->getVerificationCode() !== $verificationCode) {
            return $default;
        }

        return $entity;
    }
}
