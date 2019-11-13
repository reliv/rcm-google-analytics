<?php

namespace Reliv\RcmGoogleAnalytics\Model;

class AnalyticsAccessRcmUserAcl implements AnalyticsAccessInterface
{
    /**
     * has Access
     *
     * @return boolean
     */
    public function hasAccess()
    {
        return false; //This was disabled durring the ACL2 project because it doesn't follow new rules.
    }
}
