<?php

namespace Ginger\Util;

/**
 *  Ginger\Util\Matcher  class
 *
 * PHP version 5.5
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/semver
 *
 */

 /**
 * Matcher class
 *
 * Represents a given version
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/semver
 */

class Matcher
{

    /**
     * @param $name
     * @param $listeners
     *
     * Returns the subset of listeners matching $name
     */
    public static function filter($event, $listeners) {
        $matches = array();

        foreach($listeners as $pattern => $invokables) {
            // Direct Match
            if($event == $pattern) {
                $matches[$pattern] = $invokables;
            }
        }

        return $matches;
    }

}
 