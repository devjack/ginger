<?php


/**
 *  Ginger\Events\EventInterface  class
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

namespace Ginger\Events;

 /**
 * EventInterface class
 *
 * Represents a given version
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

interface EventInterface
{
    public function setName($name);
    public function getName();

}
 