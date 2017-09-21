<?php

namespace Reliv\RcmGoogleAnalytics;

use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Class Module
 */
class Module implements AutoloaderProviderInterface
{
    /**
     * get Autoloader Config
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * getConfig
     *
     * @return mixed
     */
    public function getConfig()
    {
        $assetManager = include __DIR__ . '/../config/asset_manager.php';
        $navigation = include __DIR__ . '/../config/navigation.php';
        $rcmUser = include __DIR__ . '/../config/rcm-user.php';
        $config = include __DIR__ . '/../config/rcm-google-analytics.php';
        $zf2Config = include __DIR__ . '/../config/zf2-config.php';

        $configManager = new ConfigAggregator(
            [
                $config['dependencies'],
                $zf2Config['service_manager']
            ]
        );

        $zf2Config['service_manager'] = $configManager->getMergedConfig();

        $configManager = new ConfigAggregator(
            [
                $assetManager,
                $navigation,
                $rcmUser,
                $config,
                $zf2Config
            ]
        );

        return $configManager->getMergedConfig();
    }
}
