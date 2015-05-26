<?php


namespace Reliv\RcmGoogleAnalytics\View\Helper;

require_once(__DIR__ . '/../../autoload.php');
require_once(__DIR__ . '/MockView.php');

/**
 * Class RcmGoogleAnalyticsJsHelperTest
 *
 * test
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\View\Helper
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsJsHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * getMockRcmGoogleAnalyticsService
     *
     * @return \PHPUnit_Framework_MockObject_MockObject | \Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics
     */
    public function getMockRcmGoogleAnalyticsService()
    {

        $return = new \Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics();

        $return->setId(123);

        $service = $this->getMockBuilder(
            '\Reliv\RcmGoogleAnalytics\Service\RcmGoogleAnalytics'
        )
            ->disableOriginalConstructor()
            ->getMock();

        $service->expects($this->any())
            ->method('getCurrentAnalyticEntity')
            ->will(
                $this->returnValue($return)
            );

        return $service;
    }

    /**
     * testInvoke
     *
     * @return void
     */
    public function testInvoke()
    {

        $config = [
            'use-analytics' => false
        ];

        $unit = new RcmGoogleAnalyticsJsHelper(
            $config,
            $this->getMockRcmGoogleAnalyticsService()
        );

        $this->assertEquals('', $unit->__invoke());

        $config = [
            'use-analytics' => true,
            'javascript-view' => 'someview'
        ];

        $unit = new RcmGoogleAnalyticsJsHelper(
            $config,
            $this->getMockRcmGoogleAnalyticsService()
        );

        $unit->setView(new MockView());

        $this->assertTrue(!empty($unit->__invoke()));

        $this->assertTrue(is_string($unit->__invoke()));
    }
}
