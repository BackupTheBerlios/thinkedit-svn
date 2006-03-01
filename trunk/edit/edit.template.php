<div class="content">

<div class="box">

<?php if (isset($out['error'])) :?>
<div class="error"><?php echo translate('error') ?> : <?php echo $out['error'] ?></div>
<?php endif;?>

			
<form name="edit_form" action="<?php echo $out['save_url']?>" method="post" onsubmit="return submitForm();">			

<?php /****************** start field rendering ***********/ ?>


<?php if (isset($out['node_field'])): ?>
<fieldset>
<legend><?php echo ucfirst(translate('metadata'));?></legend>
<?php foreach ($out['node_field'] as $field): ?>

<p>
<?php echo $field['title']; ?> :
<br/>
<?php echo $field['ui']; ?>
</p>

<?php endforeach; ?>
</fieldset>
<?php endif; ?>



<?php if (isset($out['field'])): ?>
<fieldset>
<legend><?php echo ucfirst(translate('content'));?></legend>
<?php foreach ($out['field'] as $field): ?>

<p>
<?php echo $field['title']; ?> :
<br/>
<?php echo $field['ui']; ?>
</p>

<?php endforeach; ?>
</fieldset>
<?php endif; ?>

<?php /****************** stop field rendering ***********/ ?>



<?php /****************** Relations ***********/ ?>

<?php if (isset($out['relation'])) : ?>
<fieldset>
<legend><?php echo ucfirst(translate('relation'));?></legend>



<iframe src="<?php echo $out['relation']['url']?>" name="relation" id="relation" width="600" height="200" frameborder="0"></iframe>

</fieldset>
<?php endif; ?>



<?php /****************** Locations ***********/ ?>

<!--
<fieldset>
<legend><?php echo ucfirst(translate('locations'));?></legend>
blablabla
</fieldset>
-->



<?php /****************** Save buttons ***********/ ?>

<?php if (!isset($out['edit_node'])) : ?>
<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_list_button') ?>" name="save_and_return_to_list">
<?php else: ?>
<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_node_button') ?>" name="save_and_return_to_structure">
<?php endif; ?>

</form>

</div>

</div>

