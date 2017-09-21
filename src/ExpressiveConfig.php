<?php

namespace Reliv\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ExpressiveConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            /**
             * Dependencies config
             */
            'dependencies' => [

                'factories' => [
                    \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsCreate::class
                    => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsCreateFactory::class,

                    \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsDelete::class
                    => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsDeleteFactory::class,

                    \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsFind::class
                    => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsFindFactory::class,

                    \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsUpdate::class
                    => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsUpdateFactory::class,

                    \Reliv\RcmGoogleAnalytics\Middleware\RcmGoogleAnalyticsAdminView::class
                    => \Reliv\RcmGoogleAnalytics\Middleware\RcmGoogleAnalyticsAdminViewFactory::class,

                    \Reliv\RcmGoogleAnalytics\Middleware\VerificationView::class
                    => \Reliv\RcmGoogleAnalytics\Middleware\VerificationViewFactory::class,
                ],
            ],

            'routes' => [
                'api.rcm-google-analytics.current.create' => [
                    'name' => 'api.rcm-google-analytics.current.create',
                    'path' => '/api/rcm-google-analytics/current',
                    'middleware' => [
                        'parser' => \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
                        'api' => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsCreate::class,
                    ],
                    'options' => [],
                    'allowed_methods' => ['POST'],
                ],

                'api.rcm-google-analytics.current.delete' => [
                    'name' => 'api.rcm-google-analytics.current.delete',
                    'path' => '/api/rcm-google-analytics/current',
                    'middleware' => [
                        'parser' => \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
                        'api' => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsDelete::class,
                    ],
                    'options' => [],
                    'allowed_methods' => ['DELETE'],
                ],

                'api.rcm-google-analytics.current.find' => [
                    'name' => 'api.rcm-google-analytics.current.find',
                    'path' => '/api/rcm-google-analytics/current',
                    'middleware' => [
                        'parser' => \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
                        'api' => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsFind::class,
                    ],
                    'options' => [],
                    'allowed_methods' => ['GET'],
                ],

                'api.rcm-google-analytics.current.update' => [
                    'name' => 'api.rcm-google-analytics.current.update',
                    'path' => '/api/rcm-google-analytics/current',
                    'middleware' => [
                        'parser' => \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
                        'api' => \Reliv\RcmGoogleAnalytics\Middleware\ApiRcmGoogleAnalyticsUpdate::class,
                    ],
                    'options' => [],
                    'allowed_methods' => ['PATCH'],
                ],

                'google-analytics-verification-code.html' => [
                    'name' => 'google-analytics-verification-code.html',
                    'path' => '/google:verificationCode.html',
                    'middleware' => [
                        'html' => \Reliv\RcmGoogleAnalytics\Middleware\VerificationView::class,
                    ],
                    'options' => [],
                    'allowed_methods' => ['GET'],
                ],

                'rcm-google-analytics.admin' => [
                    'name' => 'rcm-google-analytics.admin',
                    'path' => '/rcm-google-analytics',
                    'middleware' => [
                        'html' => \Reliv\RcmGoogleAnalytics\Middleware\RcmGoogleAnalyticsAdminView::class,
                    ],
                    'options' => [],
                    'allowed_methods' => ['GET'],
                ],
            ],
        ];
    }
}
