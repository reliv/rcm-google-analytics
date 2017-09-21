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
        $assetManager = include __DIR__ . '/../config/asset_manager.php';
        $navigation = include __DIR__ . '/../config/navigation.php';
        $rcmUser = include __DIR__ . '/../config/rcm-user.php';
        $config = include __DIR__ . '/../config/rcm-google-analytics.php';
        $expressiveConfig = include __DIR__ . '/../config/expressive-config.php';

        $configManager = new ConfigAggregator(
            [
                $assetManager,
                $navigation,
                $rcmUser,
                $config,
                $expressiveConfig
            ]
        );

        return $configManager->getMergedConfig();
    }
}
