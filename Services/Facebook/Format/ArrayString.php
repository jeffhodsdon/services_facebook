<?php
/**
 * PHP5 interface for Facebook's REST API
 *
 * PHP version 5.1.0+
 *
 * LICENSE: This source file is subject to the New BSD license that is 
 * available through the world-wide-web at the following URI:
 * http://www.opensource.org/licenses/bsd-license.php. If you did not receive  
 * a copy of the New BSD License and are unable to obtain it through the web, 
 * please send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Services
 * @package   Services_Facebook
 * @author    Jeff Hodsdon <jeffhodsdon@gmail.com> 
 * @copyright 2009 Jeff Hodsdon <jeffhodsdon@gmail.com>  
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/Services_Facebook
 */

require_once 'Services/Facebook/Format/Interface.php';
require_once 'Services/Facebook/Format.php';

/**
 * Services_Facebook_Format_ArrayString
 *
 * Formats an array of strings.
 *
 * @category Services
 * @package  Services_Facebook
 * @author   Jeff Hodsdon <jeffhodsdon@gmail.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://wiki.developers.facebook.com
 */
class Services_Facebook_Format_ArrayString
implements Services_Facebook_Format_Interface
{

    /**
     * Format 
     * 
     * @param SimpleXMLElement $xml Response
     *
     * @return array An array of strings
     */
    public function format(SimpleXMLElement $xml)
    {
        $string = Services_Facebook_Format::factory('String');
        $result = array();
        foreach ($xml as $item) {
            $result[] = $string->format($item);
        }

        return $result;
    }

}

?>