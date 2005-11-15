<?php


class relation
{
	
	
	function relation($table)
	{
		global $thinkedit;
		$this->table = $thinkedit->newTable($table);
		$this->config = $thinkedit->config['table'][$table];
		
		// find the two lookups fields
		foreach ($this->config['field'] as $id=>$field)
		{
			if ($field['type'] == 'lookup')
			{
				$this->lookups[$id] = $field;
			}
		}
		if (!is_array($this->lookups))
		{
			trigger_error('relation::relation() no lookups found in config file for the relation table, I need two two relate');
		}
	}
	
	function relate($source, $target)
	{
		global $thinkedit;
		$relation = $thinkedit->newRecord($this->table->getTableName());
		
		print_r ($this->lookups);
		
		foreach ($this->lookups as $field=>$lookup)
		{
			if ($lookup['source']['name'] == $source->table)
			{
				$source_field = $field;
			}
			
			if ($lookup['source']['name'] == $target->table)
			{
				$target_field = $field;
			}
			
		}
		
		$relation->field[$source_field]->set($source->getId());
		$relation->field[$target_field]->set($target->getId());
		
		return $this->table->insert($relation);
		
		
		
		
		// $relation->field['author_id'] = $source->field->id->get();
	}
	
	function unRelate($source, $target)
	{
	}
	
	function getRelations($source)
	{
		global $thinkedit;
		
		// find table of source
		$table = $source->table;
		
		// find lookup field name for the table of source
		foreach ($this->lookups as $field=>$lookup)
		{
			if ($lookup['source']['name'] == $table)
			{
				$source_field = $field;
				$source_table = $lookup['source']['name'];
			}
			
			// find target table
			if ($lookup['source']['name'] <> $table)
			{
				$target_field = $field;
				$target_table = $lookup['source']['name'];
				
			}
		}
		/*
		debug ($source_field, 'source field');
		debug($source_table, 'source_table');
		
		debug ($target_field, 'target field');
		debug($target_table, 'target_table');
		*/
		
		
		// query
		$db = $thinkedit->getDb();
		$sql= 'select * from ' .  $this->table->getTableName() . ' , ' . $target_table;
		$sql.= ' where ';
		$sql.= ' ' . $this->table->getTableName() . '.' . $source_field . ' = ' . $source->getId();
		
		$sql.= ' and ';
		$sql.= ' ' . $target_table . '.id = ' . $this->table->getTableName() . '.' . $target_field;
		
		
		$results = $db->query($sql);
		if (is_array($results))
		{
			foreach ($results as $result)
			{
				global $thinkedit;
				$record = $thinkedit->newRecord($target_table);
				$record->setArray($result);
				$records[] = $record;
			}
			return $records;
		}
		else
		{
			return false;
		}
		// send results
		
	}
	
}



?>
