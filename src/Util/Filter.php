<?php

namespace Ginger\Util;

    /**
     *  Ginger\Util\Filter  class
     *
     * PHP version 5.5
     *
     * @category
     * @package  ginger
     * @author   Jack Skinner <sydnerdrage@gmail.com>
     * @license  MIT http://opensource.org/licenses/MIT
     * @link     http://www.sydnerdrage.com/ginger
     *
     */

/**
 * Filter class
 *
 * Represents a given version
 *
 * @category
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class Filter
{

    protected $separator = ".";

    public function __construct($separator=".")
    {
        $this->separator = $separator;
    }

    /**
     * @param $name
     * @param $listeners
     *
     * Returns the subset of listeners matching $name
     */
    public function filter($subject, $patterns)
    {
        $matches = array();
        foreach ($patterns as $pattern => $attachments) {
            // Direct Match
            if ($subject == $pattern) {
                // Note this is a short circuit for speed.  Wildcards would match eventually as well.
                $matches[$pattern] = $attachments;
            }

            if ($this->singleWildcard($subject, $patterns)) {

            }

            if ($this->doubleWildcard($subject, $patterns)) {

            }
        }

        return $matches;
    }

    public function match($subject, $pattern)
    {
        // Direct Match
        if ($subject == $pattern) {
            // Note this is a short circuit for speed.  Wildcards would match eventually as well.
            return true;
        }

        if ($this->singleWildcard($subject, $pattern)) {
            return true;
        }

        if ($this->doubleWildcard($subject, $pattern)) {
            return true;
        }

        return false;
    }


    /**
     * @param $subject. May contain wildcards
     * @param $segments
     */
    protected function singleWildcard($subject, $patterns)
    {
        if(!is_array($patterns)) {
            $patterns = array($patterns);
        }
        $matches = array();
        foreach($patterns as $pattern => $index) {
            if($this->singleWildcardMatches($subject, $pattern)) {
                $matches[] = $pattern;
            }
        }

        return $matches;
    }

    /**
     * @param $subject String to match against
     * @param $pattern string containing 0 or more wildcard components
     */
    protected function singleWildcardMatches($subject, $pattern)
    {
        $subject = explode($this->separator, $subject);
        $pattern = explode($this->separator, $pattern);

        // We only check the shortest number of segments.
        $minSegments = min(count($subject), count($pattern));

        for($i=0; $i<$minSegments; $i++) {
            if($subject[$i] == $pattern[$i]) {
                // Corresponding direct string match
                continue;
            } else if($pattern[$i] == '*') {
                // Pattern segment was a wildcard - it's a match
                continue;
            } else {
                //It doesn't match
                return false;
            }

            echo PHP_EOL;
        }

        return true;
    }

    protected function doubleWildcard($needle, $segments)
    {
        //ToDo: Implement
        return false;
    }


}

