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
			
			if ($this->record->save())
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
  }
  
  function getRelations($source)
  {
	
  }
  
}



?>
