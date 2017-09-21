<?php

namespace Reliv\RcmGoogleAnalytics\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Api\Acl\IsAllowed;
use Reliv\RcmGoogleAnalytics\Api\Translate;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmGoogleAnalyticsAdminView
{
    protected $translate;
    protected $isAllowed;
    protected $templatePath;

    /**
     * @param Translate $translate
     * @param IsAllowed $isAllowed
     * @param string    $templateFile
     */
    public function __construct(
        Translate $translate,
        IsAllowed $isAllowed,
        string $templateFile = __DIR__ . '/../../view/reliv/rcm-google-analytics/index.phtml'
    ) {
        $this->translate = $translate;
        $this->isAllowed = $isAllowed;
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
        if (!$this->isAllowed->__invoke($request)) {
            return new HtmlResponse(
                $this->translate->__invoke('Access Denied: Google Analytics'),
                401
            );
        }

        ob_start();
        include($this->templateFile);
        $content = ob_get_clean();

        return new HtmlResponse(
            $content
        );
    }
}
