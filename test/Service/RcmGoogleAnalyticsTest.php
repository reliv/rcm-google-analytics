<?php


namespace Reliv\RcmGoogleAnalytics\Service;

use Rcm\Entity\Site;
use Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics as RcmGoogleAnalyticsEntity;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class RcmGoogleAnalyticsTest
 *
 * test
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\Service
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsTest extends \PHPUnit_Framework_TestCase
{
    public $testCases
        = [
            '_default' => [
                'currentSite' => [
                    'id' => 123
                ],
                'resultSite' => [
                    'id' => 123
                ],
                'entity' => [
                    'id' => 234,
                    'verificationCode' => 'VC',
                ]
            ],
            'case1' => [
                'currentSite' => [
                    'id' => 123
                ],
                'resultSite' => [
                    'id' => 123
                ],
                'entity' => null
            ]
        ];

    /**
     * getTestCase
     *
     * @param string $testCaseKey
     *
     * @return mixed
     */
    public function getTestCase($testCaseKey = '_default')
    {
        return $this->testCases[$testCaseKey];
    }

    /**
     * getMockSite
     *
     * @param $data
     *
     * @return Site
     */
    public function getMockSite($data)
    {
        $site = new Site('user123');
        $site->populate($data);

        return $site;
    }

    /**
     * getMockEntityManger
     *
     * @param $testCase
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockEntityManger($testCase)
    {
        $result = null;
        if(!empty($testCase['entity'])) {
            $result = new RcmGoogleAnalyticsEntity();
            $result->populate($testCase['entity']);
        }

        $repo = $this->getMockBuilder(
            '\Doctrine\ORM\EntityRepository'
        )
            ->disableOriginalConstructor()
            ->getMock();

        $repo->expects($this->any())
            ->method('findOneBy')
            ->will(
                $this->returnValue($result)
            );

        $service = $this->getMockBuilder(
            '\Doctrine\ORM\EntityManager'
        )
            ->disableOriginalConstructor()
            ->getMock();

        $service->expects($this->any())
            ->method('getRepository')
            ->will(
                $this->returnValue($repo)
            );

        return $service;
    }

    /**
     * testGets
     *
     * @return void
     */
    public function testGets()
    {
        $currentSite = new Site('user123');
        $currentSite->setSiteId(321);

        $default = 'DEFAULT';

        $defCase = $this->getTestCase('_default');

        $unit = new RcmGoogleAnalytics(
            $this->getMockEntityManger(
                $defCase
            ),
            $currentSite
        );

        $this->assertInstanceOf(
            '\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics',
            $unit->getSiteAnalyticEntity($currentSite, $default)
        );

        $this->assertInstanceOf(
            '\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics',
            $unit->getCurrentAnalyticEntity($default)
        );

        $this->assertInstanceOf(
            '\Reliv\RcmGoogleAnalytics\Entity\RcmGoogleAnalytics',
            $unit->getCurrentAnalyticEntityWithVerifyCode($defCase['entity']['verificationCode'])
        );

        $this->assertEquals(
            $default,
            $unit->getCurrentAnalyticEntityWithVerifyCode('nope', $default)
        );

        $unit = new RcmGoogleAnalytics(
            $this->getMockEntityManger(
                $this->getTestCase('case1')
            ),
            $currentSite
        );

        $this->assertEquals($default,
            $unit->getSiteAnalyticEntity($currentSite, $default)
        );
    }
}
