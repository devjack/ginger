<?php


/**
 *  GingerTestAssets\SimpleEvent  class
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

namespace Ginger\TestAssets;

use Ginger\Events\EventInterface;

 /**
 * SimpleEvent class
 *
 * Simple event mock
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class SimpleEvent implements EventInterface
{
    protected $name = "";

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
 