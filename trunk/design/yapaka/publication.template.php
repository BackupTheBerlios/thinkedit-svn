<?php include 'content_header.php'; ?>

<div class="content_title"><?php echo $content->getTitle() ?></div>

<div class="publication_cover">
		<?php
		// render thumbnail
		$file = $content->field['cover']->getFilesystem();
		?>
		
		<?php if ($file): ?>
		<img src="<?php echo $file->getIcon(150); ?>"/>
		<?php endif; ?>
</div>

<div class="publication_intro">
		<?php echo $content->get('intro'); ?>
</div>

<div class="publication_body">
		<?php echo $content->get('body'); ?>
</div>


<?php include 'content_footer.php'; ?>
