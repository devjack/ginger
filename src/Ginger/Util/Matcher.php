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

    protected static $separator = ".";

    /**
     * @param $name
     * @param $listeners
     *
     * Returns the subset of listeners matching $name
     */
    public static function filter($event, $listeners)
    {
        $matches = array();

        foreach ($listeners as $pattern => $invokables) {
            // Direct Match
            if ($event == $pattern) {
                echo "Direct Match".PHP_EOL;
                $matches[$pattern] = $invokables;
            }

            $needleSegments = explode(self::$separator, $event);
            $haystackSegments = explode(self::$separator, $pattern);

            if (self::singleWildcard($needleSegments, $haystackSegments)) {
                echo "Single Wildcard Match".PHP_EOL;
                $matches[$pattern] = $invokables;
            }
            if (self::doubleWildcard($needleSegments, $haystackSegments)) {
                echo "Double Wildcard Match".PHP_EOL;
                $matches[$pattern] = $invokables;
            }
        }

        return $matches;
    }

    /**
     * @param $needle Array of needle search terms. May contain wildcards
     * @param $segments
     */
    protected static function singleWildcard($needle, $segments)
    {
        return false;
    }

    protected static function doubleWildcard($needle, $segments)
    {
        return false;
    }

}
 