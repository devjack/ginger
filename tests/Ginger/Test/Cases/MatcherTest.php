<?php

namespace Ginger\Test\Cases;

use Ginger\Util\Matcher;

/**
 *  Ginger\Util\Test  class
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
 * MatcherTest class
 *
 * Tests name matching
 *
 * @category
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class MatcherTest extends \PHPUnit_Framework_TestCase
{

    public function testDirectMatch()
    {
        $event = 'ginger.test.trigger';
        // Normally the events are the key, so flip this basic list
        $listeners = array_flip(
            array(
                'ginger.test.trigger'
            )
        );

        $this->assertGreaterThan(0, Matcher::filter($event, $listeners));
    }

    public function testSingleWildcardMatch()
    {
        $event = "ginger.test.trigger";

        $listeners = array_flip(
            array(
                'ginger.*.trigger'
            )
        );

        $matches = Matcher::filter($event, $listeners);
        //$this->assertGreaterThan(0, count($matches));
    }

}
 