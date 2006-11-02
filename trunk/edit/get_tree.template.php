<?php if (isset ($out['nodes']) && is_array ($out['nodes'])): ?>
<?php foreach ($out['nodes'] as $node): ?>
<li class="node" id="node_<?php echo $node['id']?>">
<img src="<?php echo $node['icon']?>">
<?php echo $node['title']?>
</li>

<?php /******************* Context menu *******************/ ?>

<div class="context_menu" id="context_menu_node_<?php echo $node['id']?>" style="display:none">

<?php /******************* Actions *******************/ ?>
<div class="context_menu_title"><?php echo translate('actions');?></div>

<?php if (isset($node['edit_url'])): ?>
<div class="context_menu_item">
<a href="<?php echo $node['edit_url']?>" onclick="custompopup('<?php echo $node['edit_url']?>', 'editor' , 80);return false">
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


<?php if (isset($node['preview_url'])): ?>
<div class="context_menu_item">
<a href="<?php echo $node['preview_url']?>" target="thinkedit_preview">
<?php echo  $node['preview_title'];?>
</a>
</div>
<?php endif; ?>



<hr/>

<?php /******************* Clipboard *******************/ ?>

<div class="context_menu_title"><?php echo translate('clipboard');?></div>
<div class="context_menu_item">
<a href="<?php echo $node['clipboard']['cut_link']?>" target="status" onclick="hide_menus()">
<?php echo translate('cut');?>
</a>
</div>
<!--
<div class="context_menu_item">
<a href="clipboard.php" target="status"><?php echo translate('copy');?></a>
</div>
-->

<div class="context_menu_item">
<a href="<?php echo $node['clipboard']['paste_link']?>" target="status" onclick="hide_menus()"><?php echo translate('paste');?></a>
</div>


<?php if (isset($node['locale'])) : ?>

<hr/>

<?php /******************* Translate *******************/ ?>

<div class="context_menu_title"><?php echo translate('translate');?></div>
<?php foreach ($node['locale'] as $locale_info): ?>
<div class="context_menu_item">
<a href="<?php echo $locale_info['edit_url']?>"><?php echo $locale_info['locale']?></a>
</div>
<?php endforeach; ?>
<?php endif; ?>


</div>



<?php endforeach;?>
<?php endif; ?>

