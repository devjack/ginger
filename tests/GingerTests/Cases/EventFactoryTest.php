<?php


/**
 *  Ginger\Test\Cases\Test  class
 *
 * PHP version 5.5
 *
 * @category tests
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 *
 */

namespace Ginger\Test\Cases;

use Ginger\Events\EventFactory;
use Ginger\TestAssets\SimpleEvent;

 /**
 * EventFactory tests
 *
 * Test cases for EventFactory
 *
 * @category tests
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class EventFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testResolveEventName()
    {
        $event = "ginger.event-name";
        $expect = 'Ginger\EventName';

        $factory = new EventFactory();

        $result = $factory->resolveEventName($event);

        $this->assertEquals($expect, $result);
    }

    public function testEventCreated()
    {
        $factory = new EventFactory();

        $event = $factory->createEventFromName("ginger.test-assets.simple-event");

        $this->assertInstanceOf('Ginger\Events\EventInterface', $event);
    }

}

 