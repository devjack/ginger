<?php


/**
 *  Ginger\Dispatch\ListenerDispatcher  class
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

namespace Ginger\Dispatch;

use Ginger\Events\EventInterface;
use Ginger\Util\Filter;

 /**
 * ListenerDispatcher class
 *
 * Dispatches events to pre-configured listeners
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class ListenerDispatcher
{

    protected $config = array();
    /**
     * @param $config Array of listeners.
     *
     * Format is:
     *  array(
     *       'event.name.pattern' => array(
     *            "event" => "sample.core-tests-assets.first-event",
     *            "listener" => "Sample\\CoreTestsAssets\\ComplexListener",
     *            "priority" => 80,
     *        )
     *  )
     */

    protected $filter = null;


    public function addListeners($config)
    {
        if(!is_array($config)) {
            throw new \InvalidArgumentException("Config provided to setListeners was not an array. Array required");
        }

        if($this->isConfigChainValid($config)) {
            $this->config = array_merge($this->config, $config);
        } else {
            throw new \InvalidArgumentException("Config provided contained 1 or more badly formatted listeners.");
        }
    }

    public function addListener($config)
    {
        if(!is_array($config)) {
            throw new \InvalidArgumentException("Config provided to setListeners was not an array. Array required");
        }

        if($this->isConfigChainValid(array($config))){
            $this->config[] = $config;
        } else {
            throw new \InvalidArgumentException("Config provided contained a badly formatted listener.");
        }
    }

    public function setFilter(Filter $filter = null)
    {
        $this->filter = $filter;
    }

    protected function isConfigChainValid($config)
    {
        foreach($config as $listener) {
            $keys = array_keys($listener);
            if(!in_array("event", $keys)) { return false; }
            if(!in_array("listener", $keys)) { return false; }
            if(!in_array("priority", $keys)) { return false; }
        }
        return true;
    }

    public function dispatch(EventInterface $event)
    {
        $listener_chain = array();

        foreach($this->config as $listener_config) {
            if($this->filter->match($event->getName(), $listener_config['event'])) {
                $priority = $listener_config['priority'];
                if(array_key_exists((string) $priority, $listener_chain)) {
                    $listener_chain[(string)$priority][] = $listener_config;
                } else {
                    $listener_chain[(string)$priority] = array($listener_config);
                }
            }
        }

        if(0 == count($listener_chain)) {
            return; // Short circuit the triggering - no listeners matched
        }

        krsort($listener_chain);

        foreach($listener_chain as $priority => $chain) {
            foreach($chain as $listener) {
                $this->trigger($event, $listener);
            }
        }
    }

    protected function trigger(EventInterface $event, $listener_config)
    {
        // If it's a closure
        if(is_callable($listener_config['listener'])) {
            $listener_config['listener']($event);
            return;
        }

        $classname = $listener_config['listener'];

        $listener = new $classname();
        if($listener instanceof ListenerFactory) {
            $listener = $listener->construct();
        }

        $listener->trigger($event);
    }
}
 