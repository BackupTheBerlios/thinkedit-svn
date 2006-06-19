<style>
.field_box
{
		
}

</style>


<div class="content">

<div class="box inset_gray">

<?php if (isset($out['error'])) :?>
<div class="error"><?php echo translate('error') ?> : <?php echo $out['error'] ?></div>
<?php endif;?>


<form name="edit_form" action="<?php echo $out['save_url']?>" method="post" onsubmit="return submitForm();">			


<table>
<?php /****************** Field rendering ***********/ ?>
<?php if (isset($out['field'])): ?>

<?php foreach ($out['field'] as $field): ?>
		<tr>
				<td class="field_info" title="<?php echo $field['help']; ?>">
					<?php echo $field['title']; ?>
				</td>
				<td class="field_ui">
					<?php echo $field['ui']; ?>
				</td>
		</tr>
<?php endforeach; ?>

<?php endif; ?>


<?php /****************** Node properties ***********/ ?>

<?php if (isset($out['node_field'])): ?>
		
		<?php foreach ($out['node_field'] as $field): ?>
				<tr>
						<td class="field_info" title="<?php echo $field['help']; ?>">
							<?php echo $field['title']; ?>
						</td>
						<td class="field_ui">
							<?php echo $field['ui']; ?>
						</td>
				</tr>
		<?php endforeach; ?>
<?php endif; ?>


<?php /****************** Relations ***********/ ?>

<?php if (isset($out['relation'])) : ?>
		
		<tr>
				<td class="field_info" title="<?php echo $field['help']; ?>">
					<?php echo ucfirst(translate('relation'));?>
				</td>
				<td class="field_ui">
					<iframe src="<?php echo $out['relation']['url']?>" name="relation" id="relation" width="500" height="20" frameborder="0"></iframe>
				</td>
		</tr>
		
<?php endif; ?>



<?php /****************** Locations ***********/ ?>

<!--
<fieldset>
<legend><?php echo ucfirst(translate('locations'));?></legend>
blablabla
</fieldset>
-->

</table>



<?php /****************** Save buttons ***********/ ?>

<?php if (!isset($out['edit_node'])) : ?>
<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_list_button') ?>" name="save_and_return_to_list">
<?php else: ?>
<!--<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">-->
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_node_button') ?>" name="save_and_return_to_structure">
<input class="action_button" type="submit" value="<?php echo translate('cancel') ?>" name="save_and_return_to_structure" onclick="self_close(); return false;">
<?php endif; ?>

</form>

<br/>
<br/>
<br/>

</div>

</div>

