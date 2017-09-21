<?php

namespace Reliv\RcmGoogleAnalytics\Api;

use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsHydrate
{
    /**
     * @param RcmGoogleAnalytics $rcmGoogleAnalytics
     * @param array              $data
     * @param array              $options
     *
     * @return RcmGoogleAnalytics
     */
    public function __invoke(
        RcmGoogleAnalytics $rcmGoogleAnalytics,
        array $data,
        array $options = []
    ): RcmGoogleAnalytics
    {
        $prefix = 'set';

        foreach ($data as $property => $value) {

            $method = $prefix . ucfirst($property);

            if (method_exists($rcmGoogleAnalytics, $method)) {
                $rcmGoogleAnalytics->$method($value);
            }
        }

        return $rcmGoogleAnalytics;
    }

}
