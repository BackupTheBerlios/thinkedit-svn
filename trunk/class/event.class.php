<?php
/**
The event class is an event manager. It can be used to :
- register an event to observe
- call event when something happens

This is a work in progress
*/
class event
{
	
	var $events;
	
	/**
	Register a $function to be called when an $event happens
	
	Example : 
	$event->on('record_create', 'my_rss_builder');
	Would call my_rss_builder() each time a record is created
	
	*/
	function on($event, $function)
	{
		$this->events[$event][] = $function;
	}
	
	/**
	Notify the event object that something happened. 
	You can add aditional parameters those will be added to the registered function called 
	*/
	function call($event)
	{
		
		
		// see if there are any funcitons or class method registered for this $event
		
		// call each function/class method for this $event using args
		$args = func_get_args();
		
		call_user_func_array ($args);
		
		for($i = 1; $i < func_num_args(); $i++) 
		{
			$string .= $glue;
			$string .= func_get_arg($i);
		}
		
		return $string;
		
	}
}


}
?>
