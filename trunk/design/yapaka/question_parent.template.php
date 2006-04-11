<?php include 'content_header.php'; ?>

<div class="content_title">
<?php echo $content->get('title'); ?>
</div>


<?php if ($content->get('cover')): ?>
		
		<?php
		$cover_file = $content->field['cover']->getFilesystem();
		?>
		
		<div class="cover_parents">
		<img src="<?php echo $cover_file->getThumbnail(array('w' => 200) ); ?>"/>
		</div>
<?php endif; ?>

<div class="chapo_parents">
<?php echo $content->get('intro'); ?>
</div>

<div class="content_parents">
		<img src="<?php echo te_design();?>/sources/guillemets_in.gif"/>
		<?php echo $content->get('body'); ?>
		<img src="<?php echo te_design();?>/sources/guillemets_out.gif"/>
</div>


<?php include 'content_footer.php'; ?>


