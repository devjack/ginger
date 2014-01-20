<?php


/**
 *  Ginger\Listeners\ListenerInterface  class
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

namespace Ginger\Listeners;

use Ginger\Events\EventInterface;

 /**
 * ListenerInterface class
 *
 * Base listener interface.
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class ListenerInterface
{
    public function trigger(EventInterface $event);
}
 