<div id="right">
<?php 
if (is_array($debug))
{
  echo '<div class="debug">';
  //echo '<pre>';
  foreach ($debug as $debug_item)
  {
	echo $debug_item;
  }
  //echo '</pre>';
  echo '</div>';
}
?>
</div>
