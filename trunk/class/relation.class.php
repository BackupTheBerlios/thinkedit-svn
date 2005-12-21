<?php
class relation
{
  function relation($table = "relation") // todo, configure someway
  {
	global $thinkedit;
	$this->table = $table;
	//parent::record($table);
	$this->record = $thinkedit->newRecord($this->table);
	
  }
  
  function relate($source, $target)
  {
	$source_uid = $source->getUid();
	$target_uid = $target->getUid();
	
	$this->record->set('source_class', $source_uid['class']);
	$this->record->set('source_type', $source_uid['type']);
	$this->record->set('source_id', $source_uid['id']);
	
	$this->record->set('target_class', $target_uid['class']);
	$this->record->set('target_type', $target_uid['type']);
	$this->record->set('target_id', $target_uid['id']);
	
	if ($this->record->insert())
	{
	  return true;
	}
	else
	{
	  return false;
	}
	
	
  }
  
  function unRelate($source, $target)
  {
	$source_uid = $source->getUid();
	$target_uid = $target->getUid();
	
	$this->record->set('source_class', $source_uid['class']);
	$this->record->set('source_type', $source_uid['type']);
	$this->record->set('source_id', $source_uid['id']);
	
	$this->record->set('target_class', $target_uid['class']);
	$this->record->set('target_type', $target_uid['type']);
	$this->record->set('target_id', $target_uid['id']);
	
	if ($this->record->delete(true))
	{
	  return true;
	}
	else
	{
	  return false;
	}
  }
  
  function getRelations($object)
  {
	global $thinkedit;
	$uid = $object->getUid();
	
	// find any relation in the source columns
	$results_1 = $this->record->find(array('source_class' => $uid['class'], 'source_type' => $uid['type'], 'source_id' => $uid['id']));
	
	// find any relation in the target columns
	$results_2 = $this->record->find(array('target_class' => $uid['class'], 'target_type' => $uid['type'], 'target_id' => $uid['id']));
	
	if (is_array($results_1))
	{
	  foreach ($results_1 as $result)
	  {
		$uid['class'] = $result->get('target_class');
		$uid['type'] = $result->get('target_type');
		$uid['id'] = $result->get('target_id');
		$item = $thinkedit->newObject($uid);
		$items[] = $item;
	  }
	}
	
	if (is_array($results_2))
	{
	  foreach ($results_2 as $result)
	  {
		$uid['class'] = $result->get('source_class');
		$uid['type'] = $result->get('source_type');
		$uid['id'] = $result->get('source_id');
		$item = $thinkedit->newObject($uid);
		$items[] = $item;
	  }
	}
	
	if (is_array($items))
	{
	  return $item;
	}
	else
	{
	  return true;
	}
	
  }
  
}



?>
