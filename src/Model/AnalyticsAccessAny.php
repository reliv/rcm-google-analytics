<?php

namespace Reliv\RcmGoogleAnalytics\Model;

/**
 * @deprecated use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed
 *
 * @author James Jervis - https://github.com/jerv13
 */
class AnalyticsAccessAny implements AnalyticsAccessInterface
{
    /**
     * has Access
     *
     * @return boolean
     */
    public function hasAccess()
    {
        // no restrictions
        return true;
    }
}
