<?php


namespace Reliv\RcmGoogleAnalytics\View\Helper;

use Zend\View\Renderer\PhpRenderer;


/**
 * Class MockView
 *
 * MOCK for plugin magic
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmGoogleAnalytics\View\Helper
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */

class MockView extends PhpRenderer {

    public function partial(){

        return 'mock-output';
    }
}