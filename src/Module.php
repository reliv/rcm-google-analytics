<?php
/**
 * Module Config For ZF2
 */

namespace Reliv\RcmGoogleAnalytics;

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
        return include __DIR__ . '/../config/module.config.php';
    }
}
