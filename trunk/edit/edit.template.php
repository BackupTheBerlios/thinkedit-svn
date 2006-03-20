<div class="content">

<div class="box">

<?php if (isset($out['error'])) :?>
<div class="error"><?php echo translate('error') ?> : <?php echo $out['error'] ?></div>
<?php endif;?>

			
<form name="edit_form" action="<?php echo $out['save_url']?>" method="post" onsubmit="return submitForm();">			


<?php /****************** Field rendering ***********/ ?>


<?php if (isset($out['field'])): ?>
<fieldset>
<legend><?php echo ucfirst(translate('content'));?></legend>
<?php foreach ($out['field'] as $field): ?>


<div class="field_box">
<div class="field_title"><?php echo $field['title']; ?></div>

<div>
<?php echo $field['help']; ?>
</div>
<div>
<?php echo $field['ui']; ?>
</div>

</div>

<?php endforeach; ?>
</fieldset>
<?php endif; ?>


<?php /****************** Node properties ***********/ ?>

<?php if (isset($out['node_field'])): ?>
<fieldset>
<legend><?php echo ucfirst(translate('metadata'));?></legend>
<?php foreach ($out['node_field'] as $field): ?>

<div class="field_box">
<h1 class="field_title"><?php echo $field['title']; ?></h1>
<?php echo $field['help']; ?>
<br/>
<?php echo $field['ui']; ?>
</div>


<?php endforeach; ?>
</fieldset>
<?php endif; ?>


<?php /****************** Relations ***********/ ?>

<?php if (isset($out['relation'])) : ?>
<fieldset>
<legend><?php echo ucfirst(translate('relation'));?></legend>



<iframe src="<?php echo $out['relation']['url']?>" name="relation" id="relation" width="600" height="20" frameborder="0"></iframe>

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
<!--<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">-->
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_node_button') ?>" name="save_and_return_to_structure">
<?php endif; ?>

</form>

</div>

</div>

