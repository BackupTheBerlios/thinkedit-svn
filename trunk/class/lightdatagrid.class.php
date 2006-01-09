<?php
/*

Handle rendering of a data grid / list, main element of the admin interface


Deals only view the view side of things (html + persistence of list status)
Some view logic is allowed


*/
class lightdatagrid
{
  
  
		function addColumn($id, $options)
		{
				//options include sortable or not, title, ...
		}
		
		
		function add($data)
		{
				//only an array indexed by column id's with all the html needed for this datagrid
		}
		
		
		function render()
		{
		}
		
		
		function getSortInfo()
		{
		}
		
		
		
		
		
		
  
  /*
  Needs to be given an array indexed by field id
  
  $data['id'] = '1'
  $data['title'] = 'MyTitle'
  
  If a column called id and title is added, it will be shown
  
  */
  function add($data)
  {
	$this->data[] = $data; 
  }
  
  
  
  /*
  adds more than one row
  */
  function addMany($data)
  {
	foreach($data as $row)
	{
	  $this->add($row);
	}
	
  }
  
  
  /*
  Adds a single object to the datagrid. The object must provide :
  - getTitle()
  - getUid()
  */
  function addObject($object)
  {
	$this->object[] = $object; 
  }
  
  
  
  
  
  /*
  Adds a column
  */
  function addColumn($id, $args)
  {
	$this->column[$id] = $args;
	/*
	$this->column[$id]['title'] = $title;
	$this->column[$id]['sortable'] = $sortable;
	$this->column[$id]['function'] = $function;
	*/
  }
  
  
  /*
  An action performed for the whole datagrid
  */
  function addGlobalAction($id, $url, $title, $icon = false)
  {
	$action['id'] = $id;
	$action['url'] = $url;
	$action['title'] = $title;
	$action['icon'] = $icon;
	$this->global_action[] = $action;
  }
  
  
  /*
  An action performed on each row
  */
  function addLocalAction($id, $url, $title, $icon = false)
  {
	$action['id'] = $id;
	$action['url'] = $url;
	$action['title'] = $title;
	$action['icon'] = $icon;
	$this->local_action[] = $action;
  }
  
  /*
  An action performed on each row, linked to the main title in the row
  */
  function setMainAction($id, $url, $title = false)
  {
	$action['id'] = $id;
	$action['url'] = $url;
	$action['title'] = $title;
	//$action['icon'] = $icon;
	$this->main_action = $action;
  }
  
  
  function enableCheckBox()
  {
	$this->checkboxes = true;
  }
  
  
  /*
  Initialize columns first taking configured then taking simply data form this->data
  */
  function initColumn()
  {
	
  }
  
  
  function render($type='object_list')
  {
	if ($type=='list')
	{
	  return $this->renderAsList();
	}
	if ($type=='icon')
	{
	  return $this->renderAsIcons();
	}
	if ($type=='object_list')
	{
	  return $this->renderAsObjectList();
	}
  }
  
  
  function renderAsObjectList()
  {
	$out = '';
	
	$out.='<table border="1" class="datagrid">';
	
	if ($this->checkboxes)
	{
	  $out.='<th class="datagrid"><input type="checkbox"></th>';
	}
	
	if (is_array($this->column))
	{ 
	  foreach ($this->column as $id=>$column)
	  {
		$out.='<th class="datagrid">' . $column['title'] .'</th>';
	  }
	}
	else
	{
	  $out.='<th class="datagrid">' .translate('title') .'</th>';
	}
	
	if (is_array($this->local_action))
	{
	  $out.='<th class="datagrid">' . translate('datagrid_action_header') .'</th>';
	}
	
	
	if (isset($this->object) && is_array($this->object))
	{
	  foreach ($this->object as $object)
	  {
		$out.='<tr class="datagrid">';
		
		if ($this->checkboxes)
		{
		  $out.='<td class="datagrid"><input type="checkbox"></td>';
		}
		
		$out.='<td class="datagrid">'; 
		
		if (isset($this->main_action))
		{
		  require_once ROOT . '/class/url.class.php';
		  $url = new url();						
		  $out .= '<a href="' . $url->linkTo($object, $this->main_action['url']) .'">';
		  $out.=$object->getTitle();
		  $out .= '</a> ';
		}
		else
		{
		  $out.=$object->getTitle();
		}
		$out.='</td>';
		
		// add local action buttons
		if (is_array($this->local_action))
		{
		  $out .= '<td class="datagrid">';
		  foreach ($this->local_action as $action)
		  {
			require_once ROOT . '/class/url.class.php';
			$url = new url();						
			$out .= '<a href="' . $url->linkTo($object, $action['url']) .'">' . $action['title'] . '</a> ';
			
		  }
		  $out .= '</td>';
		  
		  
		}
		
		$out.='</tr>';
	  }
	}
	else
	{
	  $out.='<tr class="datagrid">';
	  $out.='<td class="datagrid">' . translate('empty_datagrid').'</td>';
	  $out.='</tr>';
	}
	
	
	
	$out .= '</table>';
	
	// add global action buttons
	if (is_array($this->global_action))
	{
	  
	  
	  foreach ($this->global_action as $action)
	  {
		require_once ROOT . '/class/url.class.php';
		$url = new url();
		$url->unsetParam('id');
		$url->setFilename($action['url']);
		require_once ROOT . '/class/button.class.php';
		$button = new button($action['title'], $url->render()); 
		
		$out .= $button->render();
		
	  }
	  
	  
	  
	}
	
	
	return $out;
  }
  
  
  
  function renderAsList()
  {
	$out = '';
	
	
	if (isset($this->pager))
	{
	  $out.=$this->pager->render();			
	}
	
	$out.='<table border="1" class="datagrid">';
	
	if (is_array($this->column))
	{ 
	  foreach ($this->column as $id=>$column)
	  {
		$out.='<th class="datagrid">' . $column['title'] .'</th>';
	  }
	}
	else
	{
	  trigger_error('datagrid::render() no column defined');
	}
	
	if (is_array($this->local_action))
	{
	  $out.='<th class="datagrid">' . translate('datagrid_action_header') .'</th>';
	}
	
	
	if (is_array($this->data))
	{
	  foreach ($this->data as $data)
	  {
		$out.='<tr class="datagrid">';
		foreach ($this->column as $id=>$column)
		{
		  $out.='<td class="datagrid">' . substr($data[$id], 0, 32) .'</td>';
		}
		
		// add local action buttons
		if (is_array($this->local_action))
		{
		  $out .= '<td class="datagrid">';
		  foreach ($this->local_action as $action)
		  {
			require_once ROOT . '/class/url.class.php';
			$url = new url();
			
			// find the primary columns to pass to the url
			foreach ($this->column as $id=>$column)
			{
			  if ($column['primary'])
			  {
				$url->setParam($id, $data[$id]);
			  }
			}
			
			$url->setFilename($action['url']);
			
			$out .= '<a href="' . $url->render() .'">' . $action['title'] . '</a> ';
			
		  }
		  $out .= '</td>';
		  
		  
		}
		
		$out.='</tr>';
	  }
	}
	else
	{
	  $out.='<tr class="datagrid">';
	  $out.='<td class="datagrid">' . translate('empty_datagrid').'</td>';
	  $out.='</tr>';
	}
	
	
	
	$out .= '</table>';
	
	// add local action buttons
	if (is_array($this->global_action))
	{
	  
	  
	  foreach ($this->global_action as $action)
	  {
		require_once ROOT . '/class/url.class.php';
		$url = new url();
		
		$url->setFilename($action['url']);
		require_once ROOT . '/class/button.class.php';
		$button = new button($action['title'], $url->render()); 
		
		$out .= $button->render();
		
	  }
	  
	  
	  
	}
	
	
	return $out;
  }
  
  
  
  
  
  function renderAsIcons()
  {
	$out = '';
	
	
	if (isset($this->pager))
	{
	  $out.=$this->pager->render();			
	}
	
	// $out.='<table border="1">';
	/*
	if (is_array($this->column))
	{
	  foreach ($this->column as $id=>$column)
	  {
		$out.='<th>' . $column['title'] .'</th>';
	  }
	}
	else
	{
	  trigger_error('datagrid::render() no column defined');
	}
	
	if (is_array($this->local_action))
	{
	  $out.='<th>' . translate('datagrid_action_header') .'</th>';
	}
	*/
	
	
	if (is_array($this->data))
	{
	  $i = 0;
	  foreach ($this->data as $data)
	  {
		$i++;
		if ($i >= count ($this->data))
		{
		  $out.='<table class="icon_table" style="float: none">';
		}
		else
		{
		  $out.='<table class="icon_table" style="float: left">';
		}
		$out.='<tr>';
		$out.='<td>';
		$out.='<img src="decoration/types/folder.png">';
		$out.='</td>';
		$out.='</tr>';
		$out.='<tr>';
		$out.='<td>';
		$out.= substr($data['title'], 0, 32);
		
		$out.='<br/>';
		
		
		// add local action buttons
		if (is_array($this->local_action))
		{
		  //$out .= '<td>';
		  foreach ($this->local_action as $action)
		  {
			require_once ROOT . '/class/url.class.php';
			$url = new url();
			
			// find the primary columns to pass to the url
			foreach ($this->column as $id=>$column)
			{
			  if ($column['primary'])
			  {
				$url->setParam($id, $data[$id]);
			  }
			}
			
			$url->setFilename($action['url']);
			
			$out .= '<a href="' . $url->render() .'">' . $action['title'] . '</a> ';
			
		  }
		}
		
		
		
		$out.='</td>';
		$out.='</tr>';
		$out.='</table>';
		
		
		
		foreach ($this->column as $id=>$column)
		{
		  // $out.='<td>' . substr($data[$id], 0, 32) .'</td>';
		}
		
		
		
		
	  }
	}
	else
	{
	  
	  translate('empty_datagrid');
	  
	}
	
	
	
	
	
	// add local action buttons
	if (is_array($this->global_action))
	{
	  
	  
	  foreach ($this->global_action as $action)
	  {
		require_once ROOT . '/class/url.class.php';
		$url = new url();
		
		$url->setFilename($action['url']);
		require_once ROOT . '/class/button.class.php';
		$button = new button($action['title'], $url->render()); 
		
		$out .= $button->render();
		
	  }
	  
	  
	  
	}
	
	
	return $out;
  }
  
  
  
  
}

?>