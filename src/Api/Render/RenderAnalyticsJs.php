<?php

namespace Reliv\RcmGoogleAnalytics\Api\Render;

use Psr\Http\Message\ServerRequestInterface;
use Reliv\RcmGoogleAnalytics\Api\Analytics\GetCurrentAnalyticEntity;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RenderAnalyticsJs implements Render
{
    protected $templatePath;
    /**
     * @var array
     */
    protected $config;

    /**
     * @var GetCurrentAnalyticEntity
     */
    protected $getCurrentAnalyticEntity;

    /**
     * @var object
     */
    protected $model;

    /**
     * @param array                    $config
     * @param GetCurrentAnalyticEntity $getCurrentAnalyticEntity
     * @param string                   $templatePath
     */
    public function __construct(
        array $config,
        GetCurrentAnalyticEntity $getCurrentAnalyticEntity,
        string $templatePath = __DIR__ . '/../../../view/'
    ) {
        $this->config = $config;
        $this->getCurrentAnalyticEntity = $getCurrentAnalyticEntity;
        $this->templatePath = $templatePath;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array|mixed            $data
     * @param array                  $options
     *
     * @return string
     */
    public function __invoke(
        ServerRequestInterface $request,
        $data,
        array $options = []
    ): string {
        if (!$this->config['use-analytics']) {
            return "";
        };

        $this->model = $this->getCurrentAnalyticEntity->__invoke(
            $request,
            new RcmGoogleAnalytics()
        );

        $template = $this->templatePath . $this->config['javascript-view'];

        ob_start();

        include($template);

        return ob_get_clean();
    }
}
