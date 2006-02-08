<div class="content">

<div class="box">

<?php if (isset($out['error'])) :?>
<div class="error"><?php echo translate('error') ?> : <?php echo $out['error'] ?></div>
<?php endif;?>

			
<form name="edit_form" action="<?php echo $out['save_url']?>" method="post" onsubmit="return submitForm();">			

<?php /****************** start field rendering ***********/ ?>

<?php if (isset($out['field'])): ?>

<?php foreach ($out['field'] as $field): ?>
<div class="detail_items_title">
<?php echo $field['title']; ?> :
</div>

<?php echo $field['ui']; ?>
<hr/>
<br/>

<?php endforeach; ?>

<?php endif; ?>

<?php /****************** stop field rendering ***********/ ?>



<?php /****************** Relations ***********/ ?>

<?php if (isset($out['relation'])) : ?>
<div class="detail_items_title">
<?php echo translate('relation'); ?> :
</div>

<iframe src="<?php echo $out['relation']['url']?>" name="relation" id="relation" width="600" height="200" frameborder="0"></iframe>

<?php endif; ?>


<hr/>

<?php /****************** Save buttons ***********/ ?>

<?php if (!isset($out['edit_node'])) : ?>
<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_list_button') ?>" name="save_and_return_to_list">
<?php else: ?>
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_node_button') ?>" name="save">
<?php endif; ?>

</form>

</div>

</div>

