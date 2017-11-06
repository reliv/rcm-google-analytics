<?php

namespace Reliv\RcmGoogleAnalytics\Api\Analytics;

use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetCurrentAnalyticEntityWithVerifyCode
{
    protected $getCurrentAnalyticEntity;

    /**
     * @param GetCurrentAnalyticEntity $getCurrentAnalyticEntity
     */
    public function __construct(
        GetCurrentAnalyticEntity $getCurrentAnalyticEntity
    ) {
        $this->getCurrentAnalyticEntity = $getCurrentAnalyticEntity;
    }

    /**
     * @param ServerRequestInterface $request
     * @param string                 $verificationCode
     * @param null                   $default
     *
     * @return null|RcmGoogleAnalytics
     */
    public function __invoke(
        ServerRequestInterface $request,
        $verificationCode,
        $default = null
    ) {
        $default = new RcmGoogleAnalytics();

        $entity = $this->getCurrentAnalyticEntity->__invoke(
            $request,
            $default
        );

        if ($entity->getVerificationCode() !== $verificationCode) {
            return $default;
        }

        return $entity;
    }
}
