<?php


namespace Reliv\RcmGoogleAnalytics\Model;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class AnalyticsAccessAnyTest
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
class AnalyticsAccessAnyTest extends \PHPUnit_Framework_TestCase {

    /**
     * testHasAccess
     *
     * @return void
     */
    public function testHasAccess()
    {
        $model = new AnalyticsAccessAny();

        $this->assertTrue($model->hasAccess());
    }
}
