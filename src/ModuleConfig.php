<?php

namespace Reliv\RcmGoogleAnalytics;

use Zend\ConfigAggregator\ConfigAggregator;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        $assetManager = new AssetManagerConfig();
        $rcmAdmin = new RcmAdminConfig();
        $rcmUser = new RcmUserConfig();
        $config = new RcmGoogleAnalyticsConfig();
        $expressiveConfig = new ExpressiveConfig();

        $configManager = new ConfigAggregator(
            [
                $assetManager,
                $rcmAdmin,
                $rcmUser,
                $config,
                $expressiveConfig
            ]
        );

        return $configManager->getMergedConfig();
    }
}
