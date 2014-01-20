<?php


/**
 *  Ginger\Events\EventFactory  class
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
 * EventFactory class
 *
 * Factory for events.  Acts as a proxy to NameResolver
 *
 * @category 
 * @package  ginger
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     http://www.sydnerdrage.com/ginger
 */

class EventFactory
{

    /**
     * @var string By default a period represents a sub-namespace within event names
     */
    protected $namespace_separator = ".";

    /**
     * @var string CamelCase classes are converted to dash-separated classes using the $class_separator
     */
    protected $class_separator = "-";

    /**
     * @var string Permit sub-namespaces as the root.
     */
    protected $root_namespace = "";


    /**
     * @param $name String Event name.
     */
    public function createEventFromName($name)
    {
        $classname = $this->resolveEventName($name);
        $event = new $classname();
        $event->setName($name);
        return $event;
    }

    public function resolveEventName($event_name)
    {
        $resolved_classes=array();
        if(!empty($this->root_namespace)) {
            $resolved_classes[] = $this->root_namespace;
        }

        $sub_events = explode($this->namespace_separator, $event_name);
        foreach($sub_events as $sub_event) {
            $resolved_classes[] = $this->joinClassName($sub_event);
        }
        $resolved_name = implode("\\", $resolved_classes);
        return $resolved_name;
    }

    protected function joinClassName($sub_event="")
    {
        $class="";
        $class_name = explode($this->class_separator, $sub_event);
        foreach($class_name as $word) {
            // This is where we convert abc-Def to Abc-Def
            $class .= ucfirst($word);
        }
        return $class;
    }
}
 