<?php
/**
The event class is an event manager. It can be used to :
- register an event to observe
- call event when something happens

This is a work in progress
*/
class event
{
		
		/**
		Register a $function to be called when an $event happens
		
		Example : 
		$event->register('record_create', 'my_rss_builder');
		  Would call my_rss_builder() each time a record is created
		
		*/
		function register($event, $function)
		{
				
		}
		
		/**
		Notify the event object that something happened. 
		You can add aditional parameters those will be added to the registered function called 
		*/
		function call($event)
		{
				
		}
		
		
}
?>
