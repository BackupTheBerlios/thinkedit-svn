<iframe name="status" width="500" height="30" frameborder="0" scrolling="no"></iframe>



<div class="content" id="list">

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




<div class="power_margin">



<?php //if (!$thinkedit->outputcache->start('interface_node_' . $current_node->getId())): ?>

<?php if (isset($out['go_up_url'])): ?>
<a class="" style="margin-bottom: 30px;" href="<?php echo $out['go_up_url'] ?>"><?php echo translate('go_up')?></a>
<?php endif;?>

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

if (isset($node['is_current']))
{
		$class = "tr_hilight";
}

$i++;
?>

<tr class="<?php echo $class?>" id="node_<?php echo $node['id']?>">


<td class="power_cell power_cell_border" style="cursor:pointer" onClick="document.location.href='<?php echo $node['url']?>';">
<a href="<?php echo $node['url']?>" title="<?php echo  $node['full_title'] ?>">
<div style="float: left; width: <?php echo ($node['level'] * 20)?>px; border: 0px solid black">&nbsp;</div>

<?php if (isset($node['helper_icon'])): ?>
<img src="<?php echo $node['helper_icon']; ?>" style="vertical-align: middle;">
<?php endif; ?>

<img src="<?php echo $node['icon']; ?>" style="vertical-align: middle;">
<?php echo  $node['title'] ?>
</a>
</td>


<td class="power_cell power_cell_border">

<a class="action_button" onclick="toggle_and_move('context_menu_node_<?php echo $node['id']?>', event)">
<?php echo translate('menu');?>
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


<?php /******************* Context menu *******************/ ?>

<div class="context_menu" id="context_menu_node_<?php echo $node['id']?>" style="display:none">

<?php /******************* Actions *******************/ ?>
<div class="context_menu_title"><?php echo translate('actions');?></div>

<?php if (isset($node['edit_url'])): ?>
<div class="context_menu_item">
<a href="<?php echo $node['edit_url']?>">
<img src="ressource/image/icon/small/accessories-text-editor.png" border="0" alt="<?php echo translate('node_edit'); ?>">
<?php echo translate('edit'); ?>
</a>
</div>
<?php endif; ?>

<?php if (isset($node['delete_url'])): ?>
<div class="context_menu_item">
<a href="<?php echo $node['delete_url']?>" onClick="JavaScript:confirm_link('<?php echo translate('confirm_node_delete') ?>', '<?php echo $node['delete_url']?>'); return false;">
<img src="ressource/image/icon/small/user-trash-full.png" title="<?php echo translate('delete'); ?>">
<?php echo translate('delete')?>
</a>
</div>
<?php endif; ?>


<?php if (isset($node['publish_url'])): ?>
<div class="context_menu_item">
<a href="<?php echo $node['publish_url']?>">
<?php if ($node['published']): ?>
<img src="ressource/image/icon/small/lightbulb.png" title="<?php echo  $node['publish_title'];?>">
<?php echo translate('unpublish')?>
<?php else: ?>
<img src="ressource/image/icon/small/lightbulb_off.png" title="<?php echo  $node['publish_title'];?>">
<?php echo translate('publish')?>
<?php endif; ?>
</a>
</div>
<?php endif; ?>


<?php if (isset($node['preview_url'])): ?>
<div class="context_menu_item">
<a href="<?php echo $node['preview_url']?>" target="_blank">
<?php echo  $node['preview_title'];?>
</a>
</div>
<?php endif; ?>



<hr/>

<?php /******************* Clipboard *******************/ ?>

<div class="context_menu_title"><?php echo translate('clipboard');?></div>
<div class="context_menu_item">
<a href="" target="status"><?php echo translate('cut');?></a>
</div>

<div class="context_menu_item">
<a href="" target="status"><?php echo translate('copy');?></a>
</div>

<div class="context_menu_item">
<a href="" target="status"><?php echo translate('paste');?></a>
</div>

<hr/>


<?php /******************* Translate *******************/ ?>

<div class="context_menu_title"><?php echo translate('translate');?></div>

<div class="context_menu_item">
<a href="" target="status">Français</a>
</div>

<div class="context_menu_item">
<a href="" target="status">English</a>
</div>


<hr/>

<?php /******************* Add subitems *******************/ ?>

<div class="context_menu_title"><?php echo translate('node_add_new');?></div>

<?php if (isset($node['allowed_items'])) : ?>
<?php foreach ($node['allowed_items'] as $item): ?>
<div class="context_menu_item">
<a href="<?php echo $item['action'] ?>">
<?php echo ucfirst($item['title']) ?>
</a>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php echo translate('cannot_add_here');?>
<?php endif; ?>


</div>



</td>

</tr>
<?php endforeach; ?>

</table>
<?php else: ?>
<div class="white bigbox">
<?php echo translate('node_empty')?>
</div>
<?php endif; ?>


<?php //$thinkedit->outputcache->end();?>

<?php //endif; ?>

</div>




</div>
