<?php


namespace Reliv\RcmGoogleAnalytics\Model;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class AnalyticsAccessRcmUserAclTest
 *
 * test
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\Model
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class AnalyticsAccessRcmUserAclTest extends \PHPUnit_Framework_TestCase
{

    /**
     * getMockRcmUserService
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\RcmUser\Service\RcmUserService
     */
    public function getMockRcmUserService()
    {
        $service = $this->getMockBuilder(
            '\RcmUser\Service\RcmUserService'
        )
            ->disableOriginalConstructor()
            ->getMock();

//        $service->expects($this->any())
//            ->method('isAllowed')
//            ->will(
//                $this->returnValue(true)
//            );

        return $service;
    }

    /**
     * testHasAccess
     *
     * @return void
     */
    public function testHasAccess()
    {
        $service = $this->getMockRcmUserService();
        $model = new AnalyticsAccessRcmUserAcl($service);

        $this->assertTrue($model->hasAccess());
    }
}
