<?php

  require_once 'url.class.php';
  require_once 'root.class.php';

  /**
  * Handle rendering of a browser list, main element of the admin interface
  */
  class browser
  {

    function browser($data)
    {

      // first case : we are receiving an object with tree support
      // (we consider that having hasChildren method, means we support trees),
      // -> we enable a hierarchical browser
      if ( (is_object($data)) and method_exists($data, 'hasChildren') )
      {
        if ($data->hasParent())
        {
          debug ('node with parent');
          $parent = $data->getParent();
          $module = $parent->getModule();
          $module->is_parent = true; // a little hack used to see if it is a parent
          $this->data[] = $module;
        }
        else
        {
          $module = new root();
          $module->is_parent = true; // a little hack used to see if it is a parent
          $this->data[] = $module;
        }
        if ($data->hasChildren())
        {
          debug ('node with children');
          $children = $data->getChildren();
          foreach ($children as $child)
          {
            $this->data[] = $child->getModule();
						//$this->data[] = $child;
          }
        }
      }
      // second case : a module list, we consider it to be a list of some sort
      elseif (get_class($data) == 'module_list')
      {
        $debug('module list');
        $this->module_list = $data;
        trigger_error('module_list object not yet / deprecated (?)');
      }
      // third case : a general array, we consider it to be a list of modules
      elseif (is_array($data))
      {
        $this->data = $data;
      }
      else
      {
        die ('not implemented');
      }
    }


    function setDecorationPath($path)
    {
      $this->decoration_path = $path;
    }

    function getDecorationPath()
    {
      if (isset($this->decoration_path))
      {
        return $this->decoration_path;
      }
      else
      {
        return 'decoration/';
      }
    }

    function render()
    {
      $out='<table border="1">';

			$out.='<th>' . translate('browser_icon_header') .'</th>';
			$out.='<th>' . translate('browser_title_header') .'</th>';
			$out.='<th>' . translate('browser_action_header') .'</th>';
			
      $url = new url();

      if (is_array($this->data))
      {
        // print_r($list);

        foreach ($this->data as $item)
        {
          $url->setParam('node_id', $item->getId());
          $out .= '<tr>';
          
					// Icon
					$out .= '<td>';
          $out .= '<a href="'.  $url->render() . '">';
          if ($item->is_parent)
          {
          $out .= '<img src="'. $this->getDecorationPath() . '/icons/up.png' . '" alt=".." border="0">';
          }
					else
					{
					$out .= '<img src="'. $this->getDecorationPath() . '/types/' . $item->getIcon() . '" alt="Icon" border="0">';
					}
          $out .= '</a>';
          $out .= '</td>';
          
					// Title
					$out .= '<td>';
          $out .= '<a href="'. $url->render() . '">';
          if ($item->is_parent)
          {
            $out .= '.. ';
						//$out .= '<img src="'. $this->getDecorationPath() . '/icons/up.png' . '" alt=".." border="0">';
          }
          $out .= $item->getTitle();
          //$out .= '</a>';
          $out .= '</td>';
					
					
					// Action
					$out .= '<td>';
					
					if ($item->isEditable())
					{
          $out .= '<a href="'. $url->render('edit.php') . '">';
          $out .= translate('browser_edit_button');
					$out .= '</a> ';
					}
					
					
          $out .= '<a href="'. $url->render('delete.php') . '">';
          $out .= translate('browser_delete_button');
					$out .= '</a> ';
					
          $out .= '</td>';

					
          $out .= '</tr>';
        }
      }
      else
      {
        $out .= translate('empty_browser');
      }


      $out .= '</table>';
      return $out;
    }




  }



?>