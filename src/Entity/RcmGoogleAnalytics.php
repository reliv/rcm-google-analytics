<?php

namespace Reliv\RcmGoogleAnalytics\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author James Jervis - https://github.com/jerv13
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
     * @var string
     *
     * @ORM\Column(type="string")
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
        $this->id = $id;
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
}
