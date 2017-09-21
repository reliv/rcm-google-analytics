<?php

namespace Reliv\RcmGoogleAnalytics\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;
use Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics as RcmGoogleAnalyticsService;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class VerificationView
{
    protected $rcmGoogleAnalyticsService;

    protected $templateFile;

    protected $model;

    /**
     * @param RcmGoogleAnalyticsService $rcmGoogleAnalyticsService
     * @param string                    $templateFile
     */
    public function __construct(
        RcmGoogleAnalyticsService $rcmGoogleAnalyticsService,
        string $templateFile = __DIR__ . '/../../view/reliv/verification/index.phtml'
    ) {
        $this->rcmGoogleAnalyticsService = $rcmGoogleAnalyticsService;
        $this->templateFile = $templateFile;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface|HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        $requestVerificationCode = $request->getAttribute('verificationCode');

        $model = $this->rcmGoogleAnalyticsService
            ->getCurrentAnalyticEntityWithVerifyCode(
                $requestVerificationCode,
                new RcmGoogleAnalytics()
            );

        $verificationCode = $model->getVerificationCode();

        if (empty($verificationCode)) {
            return new HtmlResponse(
                '',
                404
            );
        }

        $this->model = $model;

        ob_start();
        include($this->templateFile);
        $content = ob_get_clean();

        return new HtmlResponse(
            $content
        );
    }
}
