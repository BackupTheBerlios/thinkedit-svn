
<script LANGUAGE="JavaScript">
<!--

function jump(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>



<script language="JavaScript">
<!--
function confirm_link(message, url)
{
		input_box=confirm(message);
		if (input_box==true)
		
		{ 
				// Output when OK is clicked
				window.location.href=url; 
		}
		
		else
		{
				return false;
		}
		
}
--></script>


<div class="content">


<div class="path_chooser">

<?php if (isset($out['folders'])) : ?>
<select size="1" onChange="jump('parent',this,0)">
<?php foreach ($out['folders'] as $folder): ?>

<?php 
if (isset($folder['current']))
{
$selected='selected = "selected"';
}
else
{
$selected='';
} 

?>

<option value="<?php echo $folder['url'] ?>" <?php echo $selected ?> ><?php echo  $folder['path'] ?></option>

<?php endforeach; ?>
</select>
<?php endif; ?>

</div>


<div>

<?php echo translate('you_are_here') ?> : 

<?php $x=1 ?>

<?php foreach ($out['structure_breadcrumb'] as $breadcrumb) : ?>

<a class="structure_breadcrumb" href="<?php echo $breadcrumb['url']  ?>"><?php echo $breadcrumb['title']  ?>  </a>

<?php if ($x < count($out['structure_breadcrumb'])): ?>
 > 
<?php endif;?>

<?php $x++ ?>
<?php endforeach; ?>


</div>


<div class="power_margin">

<?php if (isset($out['nodes'])) : ?>

<table class="power_table" border="0" cellspacing="0" cellpadding="0">
<?php  $i=0 ?>

<?php foreach ($out['nodes'] as $node): ?>


<?php 
// used to alternate rows, of course)
if (($i % 2)==0)
{
$class = "tr_off";
}
else
{
$class = "tr_on";
}
$i++;

?>

<tr class="<?php echo $class?>">

<td class="power_cell power_cell_border">
<img class="preview" src="<?php echo $node['icon']; ?>">
</td>

<td class="power_cell power_cell_border">
<a href="<?php echo $node['url']?>">
<?php echo  $node['title'] ?>
</a>
</td>

<td class="power_cell power_cell_border" style="cursor:pointer">

<a href="<?php echo $node['delete_url']?>" onClick="JavaScript:confirm_link('<?php echo translate('confirm_delete') ?>', '<?php echo $file['delete_url']?>'); return false;">
<?php echo translate('node_delete'); ?>
</a>

<?php /* <a href="edit.php?id=<?php echo  $file['id'] ?>&module=<?php echo $filemanager_id?>">[edit details]</a> */?>
</td>

</tr>
<?php endforeach; ?>

</table>
<?php else: ?>
<?php echo translate('node_empty')?>
<?php endif; ?>

</div>



<div class="node_actions">

<p>
<?php if (isset($out['allowed_items'])) : ?>
<select size="1" onChange="jump('parent',this,0)">
<option value=""><?php echo translate('node_add_new') ?></option>
<?php foreach ($out['allowed_items'] as $item): ?>
<option value="<?php echo $item['action'] ?>"><?php echo ucfirst($item['title']) ?></option>
<?php endforeach; ?>
</select>
<?php endif; ?>
</p>
</div>



</div>
