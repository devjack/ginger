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
 * @link     http://www.sydnerdrage.com/semver
 *
 */

namespace Ginger\Test\Cases;

use Ginger\TestAssets\SimpleEvent;
use Ginger\Dispatch\ListenerDispatcher;
use Ginger\Util\Filter;

 /**
 * Test class
 *
 * Represents a given version
 *
 * @category tests
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/semver
 */

class Test extends \PHPUnit_Framework_TestCase {

    public function testClosureDispatch()
    {
        $event = new SimpleEvent();
        $event->setName("ginger.event-name");
        $dispatcher = new ListenerDispatcher();
        $filter = new Filter();

        $dispatcher->setFilter($filter);

        // Pass by ref a false val.  If it's true, the listener executed.
        $assert = false;
        $config = array(
            array(
                 "event" => "ginger.event-name",
                 "listener" => function($event) use(&$assert) {
                         // $assert is passed by reference.
                         $assert = true;
                     },
                 "priority" => 80,
             )
        );
        $dispatcher->addListeners($config);
        $dispatcher->dispatch($event);
        //  This should be true if the listener ran.  If not, test fails!
        $this->assertTrue($assert);
    }

    public function testPriorities()
    {
        $event = new SimpleEvent();
        $event->setName("ginger.event-name");
        $dispatcher = new ListenerDispatcher();
        $filter = new Filter();

        $dispatcher->setFilter($filter);

        // Passed by reference.  Test ordering of array elements to test priorities
        $assert = array();

        // Note the lower priority is listed first to ensure it's not simple "order that its added"
        $config = array(
            array(
                "event" => "ginger.event-name",
                "listener" => function($event) use(&$assert) {
                        // $assert is passed by reference.
                        $assert[] = 'first';
                    },
                "priority" => 70,
            ),
            array(
                "event" => "ginger.event-name",
                "listener" => function($event) use(&$assert) {
                        // $assert is passed by reference.
                        $assert[] = 'second';
                    },
                "priority" => 80,
            )
        );
        $dispatcher->addListeners($config);
        $dispatcher->dispatch($event);
        //  This should be true if the listener ran.  If not, test fails!
        $this->assertEquals("first", $assert[0]);
        $this->assertEquals("second", $assert[1]);
    }



}

 