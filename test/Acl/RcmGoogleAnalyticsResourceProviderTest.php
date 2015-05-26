<?php


namespace Reliv\RcmGoogleAnalytics\Acl;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class RcmGoogleAnalyticsResourceProviderTest
 *
 * test
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\Acl
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmGoogleAnalyticsResourceProviderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * testGet
     *
     * @return void
     */
    public function testGet()
    {
        $provider = new RcmGoogleAnalyticsResourceProvider(null);

        $resources = $provider->getResources();

        $this->assertTrue(is_array($resources));

        $this->assertArrayHasKey(RcmGoogleAnalyticsResourceProvider::RESOURCE_ID,
            $resources);

        $resource
            = $provider->getResource(RcmGoogleAnalyticsResourceProvider::RESOURCE_ID);

        $this->assertInstanceOf('Zend\Permissions\Acl\Resource\ResourceInterface',
            $resource);
    }
}
