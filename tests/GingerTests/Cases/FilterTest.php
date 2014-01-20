<?php

namespace Ginger\Test\Cases;

use Ginger\Util\Filter;

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

        $matcher = new Filter();
        
        $this->assertGreaterThan(0, $matcher->filter($event, $listeners));
    }

    public function testSingleWildcardMatch()
    {
        $event = "ginger.test.trigger";

        // All of these should be match the above
        $listeners = array_flip(
            array(
                'ginger.*.trigger',
                'ginger.test.*',
                '*.test.trigger'
            )
        );

        $matcher = new Filter();

        $matches = $matcher->filter($event, $listeners);
        //$this->assertEquals(count($listeners), count($matches));
    }

}
 