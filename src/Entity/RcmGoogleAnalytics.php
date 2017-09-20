<?php

namespace Reliv\RcmGoogleAnalytics\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rcm\Entity\AbstractApiModel;
use Rcm\Entity\Site;

/**
 * Class GoogleAnalytics
 *
 * Entity
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
 *
 * @ORM\Entity
 * @ORM\Table(name="rcm_google_analytics")
 */
class RcmGoogleAnalytics extends AbstractApiModel
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $trackingId = null;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $verificationCode;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $siteId;

    /**
     * get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set Id
     *
     * @param $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

    /**
     * get TrackingId
     *
     * @return string
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * set TrackingId
     *
     * @param $trackingId
     *
     * @return void
     */
    public function setTrackingId($trackingId)
    {
        $this->trackingId = (string)$trackingId;
    }

    /**
     * has Tracking
     *
     * @return bool
     */
    public function hasTracking()
    {
        return !empty($this->trackingId);
    }

    /**
     * get VerificationCode
     *
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->verificationCode;
    }

    /**
     * set VerificationCode
     *
     * @param string $verificationCode
     *
     * @return void
     */
    public function setVerificationCode($verificationCode)
    {
        $this->verificationCode = (string)$verificationCode;
    }

    /**
     * has VerificationCode
     *
     * @return bool
     */
    public function hasVerificationCode()
    {
        return !empty($this->verificationCode);
    }

    /**
     * @param $siteId
     *
     * @return void
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;
    }

    /**
     * @return int|string
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * @deprecated
     *
     * @return \Rcm\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @deprecated
     *
     * @param \Rcm\Entity\Site $site
     *
     * @return void
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
        $this->siteId = $site->getSiteId();
    }

    /**
     * @deprecated
     *
     * @return null|string
     */
    public function getHost()
    {
        if (empty($this->site)) {
            return null;
        }

        $domain = $this->site->getDomain();

        if (empty($domain) || empty($domain->getDomainName())) {
            return null;
        }

        return $domain->getDomainName();
    }

    /**
     * @param array $ignore
     *
     * @return array
     */
    public function toArray($ignore = [])
    {
        $array = parent::toArray();

        //$array['host'] = $this->getHost();

        unset($array['site']);

        return $array;
    }
}
