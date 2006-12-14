<?php
/**
The event class is an event manager. It can be used to :
- register an event to observe
- call event when something happens

This is a work in progress

todo : explain carefully what this does. 
This seems to be the observer pattern implemented in a very limited amount of lines :-)


Let's say you want to be notified when a record is saved

Inside the record class, everytime a record is saved, we (already/will soon) do this : 

$thinkedit->event->trigger('record_save', $this);

This means : "hey, I just saved a record, you can find it's content inside $this"


Now let's say you want to register your supper loger plugin :

$thinkedit->event->bind('record_save', 'mylogger::log()');

class mylogger
{
	function log($record)
	{
		echo $record->getTitle() . ' has been saved';
	}
}
*/

define('NULL_ARG', 'DUMMY_ARGUMENT');

class event
{
	
	var $events;
	
	/**
	Register a $function to be called when an $event happens
	
	Example : 
	$event->bind('record_create', 'my_rss_builder');
	Would call my_rss_builder() each time a record is created
	
	*/
	function bind($event, $function, $priority = 1)
	{
		$this->events[$event][] = $function;
	}
	
	/**
	Notify the event object that something happened. 
	You can add aditional parameters those will be added to the registered function called
	
	Because of a limitation of php4, we use an ugly hack documented here : http://be2.php.net/manual/en/function.func-get-args.php#18350
	*/
	function trigger($event, $arg0 = NULL_ARG, $arg1 = NULL_ARG, $arg2 = NULL_ARG,  $arg3 = NULL_ARG, $arg4 = NULL_ARG,$arg5 = NULL_ARG, $arg6 = NULL_ARG,$arg7 = NULL_ARG, $arg8 = NULL_ARG, $arg9 = NULL_ARG)	
	{
		$this->triggered_events[] = $event;
		
		// see if there are any functions or class method registered for this $event
		if (isset($this->events[$event]) && is_array($this->events[$event]))
		{
			
			// call each function/class method for this $event using args
			
			/*
			// removes first arg (the $event name)
			for($i = 1; $i < func_num_args(); $i++) 
			{
				$args[] = func_get_arg($i);
			}
			*/
			
			
			// new solution, involves ugly hack
			for ($args=array(), $i=0; $i < 10; $i++) 
			{
				$name = 'arg' . $i;
				if ($i < func_num_args()) 
				{
					$args[$i] = &$$name;
				}
				unset($$name, $name);
			}
			
			foreach ($this->events[$event] as $event)
			{
				call_user_func_array ($event, $args);
			}
			
		}
		
	}
	
	
	function debug()
	{
		if (is_array($this->triggered_events))
		{
			$out = '<h1>List of event encountered so far</h1>';
			foreach($this->triggered_events as $event)
			{
				$out .= '<li>' . $event . '</li>';
			}
		}
		else
		{
			$out = '<h1>No event encountered so far</h1>';
		}
		
		return $out;
	}
	
}
?>
