<div class="content">

<div class="white bigbox">

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


<div class="box">

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

<a href="<?php echo $node['edit_url']?>">
<img src="ressource/image/icon/small/accessories-text-editor.png" border="0" alt="<?php echo translate('node_edit'); ?>">
</a>


<?php if (isset($node['movetop_url'])): ?>
<a href="<?php echo $node['movetop_url']?>">
<img src="ressource/image/icon/small/go-top.png">
</a>
<?php endif; ?>

<?php if (isset($node['moveup_url'])): ?>
<a href="<?php echo $node['moveup_url']?>">
<img src="ressource/image/icon/small/go-up.png">
</a>
<?php endif; ?>

<?php if (isset($node['movedown_url'])): ?>
<a href="<?php echo $node['movedown_url']?>">
<img src="ressource/image/icon/small/go-down.png">
</a>
<?php endif; ?>

<?php if (isset($node['movebottom_url'])): ?>
<a href="<?php echo $node['movebottom_url']?>">
<img src="ressource/image/icon/small/go-bottom.png">
</a>
<?php endif; ?>



<a href="<?php echo $node['delete_url']?>" onClick="JavaScript:confirm_link('<?php echo translate('confirm_node_delete') ?>', '<?php echo $node['delete_url']?>'); return false;">
<img src="ressource/image/icon/small/edit-delete.png" border="0" alt="<?php echo translate('node_delete'); ?>">
</a>

<?php if (isset($node['publish_url'])): ?>
<a class="action_button" href="<?php echo $node['publish_url']?>">
<?php echo  $node['publish_title'];?>
</a>
<?php endif; ?>




</td>

</tr>
<?php endforeach; ?>

</table>
<?php else: ?>
<div class="white bigbox">
<?php echo translate('node_empty')?>
</div>
<?php endif; ?>

</div>




</div>
