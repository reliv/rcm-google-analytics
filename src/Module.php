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
        $assetManager = new AssetManagerConfig();
        $rcmAdmin = new RcmAdminConfig();
        $rcmUser = new RcmUserConfig();
        $config = new RcmGoogleAnalyticsConfig();
        $zf2Config = new Zf2Config();

        $configManager = new ConfigAggregator(
            [
                $assetManager,
                $rcmAdmin,
                $rcmUser,
                $config,
                $zf2Config
            ]
        );

        $config = $configManager->getMergedConfig();

        $config['service_manager'] = array_merge($config['service_manager'], $config['dependencies']);

        return $config;
    }
}
