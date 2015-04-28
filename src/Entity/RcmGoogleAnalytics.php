<?php

namespace Reliv\RcmGoogleAnalytics\Entity;

use Doctrine\ORM\Mapping as ORM;
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
class RcmGoogleAnalytics
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
     * @var \Rcm\Entity\Site
     *
     * @ORM\OneToOne(targetEntity="\Rcm\Entity\Site")
     * @ORM\JoinColumn(
     *     name="siteId",
     *     referencedColumnName="siteId",
     *     onDelete="CASCADE"
     * )
     */
    protected $site;

    /**
     * getId
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setId
     *
     * @param $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getTrackingId
     *
     * @return string
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * setTrackingId
     *
     * @param $trackingId
     *
     * @return void
     */
    public function setTrackingId($trackingId)
    {
        $this->trackingId = $trackingId;
    }

    /**
     * hasAccount
     *
     * @return bool
     */
    public function hasTracking()
    {
        return !empty($this->trackingId);
    }

    /**
     * getVerificationCode
     *
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->verificationCode;
    }

    /**
     * setVerificationCode
     *
     * @param string $verificationCode
     *
     * @return void
     */
    public function setVerificationCode($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    /**
     * getSite
     *
     * @return \Rcm\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * setSite
     *
     * @param \Rcm\Entity\Site $site
     *
     * @return void
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
    }

    /**
     * getHost
     *
     * @return void
     */
    public function getHost()
    {
        return $this->site->getDomain()->getDomainName();
    }
}