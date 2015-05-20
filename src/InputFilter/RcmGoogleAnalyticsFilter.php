<?php

namespace Reliv\RcmGoogleAnalytics\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Class RcmGoogleAnalyticsFilter
 *
 * RcmGoogleAnalyticsFilter
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\InputFilter
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsFilter extends InputFilter
{
    /**
     * @var array
     */
    protected $filterConfig = [
            //'id' => [], // unused
            //'siteId' => [], // unused
            //'host' => [], // unused
            'trackingId' => [
                'name' => 'trackingId',
                'required' => false,
                'filters' => [
                    ['name' => 'Zend\Filter\StripTags'],
                    ['name' => 'StringTrim'],
                ],
                //'validators' => [
                //    [
                //        'name' => 'Zend\Validator\NotEmpty',
                //        'options' => [
                //            'type' => 'string'
                //        ],
                //    ],
                //],
            ],
            'verificationCode' => [
                'name' => 'verificationCode',
                'required' => false,
                'filters' => [
                    ['name' => 'Zend\Filter\StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],
        ];

    /**
     *
     */
    public function __construct()
    {
        $this->build();
    }

    /**
     * build input filter from config
     *
     * @return void
     */
    protected function build()
    {
        $factory = $this->getFactory();

        foreach ($this->filterConfig as $field => $config) {
            $this->add(
                $factory->createInput(
                    $config
                )
            );
        }
    }
}
