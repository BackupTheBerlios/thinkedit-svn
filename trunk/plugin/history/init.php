<?php
/************** History plugin initialisation ***************/

$thinkedit->event->bind('record_before_delete', 'history_record_delete_handler');



function history_record_delete_handler($record)
{
	global $thinkedit;
	$history = $thinkedit->newRecord('history');
	$history->set('event', 'record_deleted');
	
	//echo $record->debug();
	$record->load();
	$history->set('title', 'The record titled ' . $record->getTitle() . ' has been deleted');
	
	// todo check if we can store serialized data directly
	$history->set('data', serialize($record->getArray()) );
	$history->insert();
}

?>
