<?php


  class breadcrumb
  {

    function add($title, $url=false)
    {
      $bread['title'] = $title;
      $bread['url'] = $url;
      $this->data[] = $bread;
    }


    function render()
    {
      if (is_array($this->data))
      {
        foreach ($this->data as $bread)
        {
          if ($bread['url'])
					{
					$refs[]= '<a href="' . $bread['url'] . '">' . $bread['title'] . '</a>';
					}
					else
					{
					$refs[]= $bread['title'];
					}
        }
				$out .= implode(' &gt; ', $refs);
      }
      else
      {
        $out='Breadcrumb empty';
      }

      return $out;
    }


  }

?>
