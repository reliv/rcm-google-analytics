<?php


namespace Reliv\RcmGoogleAnalytics\Entity;

use Rcm\Entity\Domain;
use Rcm\Entity\Site;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class RcmGoogleAnalyticsTest
 *
 * test
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\Entity
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * testSetGet
     *
     * @return void
     */
    public function testSetGet()
    {
        $entity = new RcmGoogleAnalytics();

        $data = [
            'id' => 123,
            'trackingId' => 'UA00000',
            'verificationCode' => 'ggggg',
            'siteId' => 321,
            'host' => 'test.example.com'
        ];

        $domain = new Domain();
        $domain->setDomainName('test.example.com');

        $data['site'] = new Site();
        $data['site']->setSiteId(3211);
        $data['site']->setDomain($domain);

        $entity->setId($data['id']);
        $this->assertEquals($data['id'], $entity->getId());

        $entity->setTrackingId($data['trackingId']);
        $this->assertEquals($data['trackingId'], $entity->getTrackingId());
        $this->assertTrue($entity->hasTracking());

        $entity->setVerificationCode($data['verificationCode']);
        $this->assertEquals($data['verificationCode'],
            $entity->getVerificationCode());
        $this->assertTrue($entity->hasVerificationCode());

        $entity->setVerificationCode($data['verificationCode']);
        $this->assertEquals($data['verificationCode'],
            $entity->getVerificationCode());
        $this->assertTrue($entity->hasVerificationCode());

        $entity->setSite($data['site']);
        $this->assertEquals($data['site'], $entity->getSite());
        $this->assertEquals($data['site']->getSiteId(), $entity->getSiteId());
        $this->assertEquals($data['site']->getDomain()->getDomainName(),
            $entity->getHost());

        $array = $entity->toArray();
        $this->assertTrue(is_array($array));
        $this->assertEquals($data['host'], $array['host']);
    }
}
