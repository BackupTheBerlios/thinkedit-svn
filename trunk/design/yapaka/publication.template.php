<div class="content_title"><?php echo $content->getTitle() ?></div>


<p style="float: right; padding: 20px">
		<?php
		// render thumbnail
		$file = $content->field['cover']->getFilesystem();
		?>
		
		<?php if ($file): ?>
		<img src="<?php echo $file->getIcon(150); ?>"/>
		<?php endif; ?>
</p>

<p>
		<?php echo $content->get('intro'); ?>
</p>

<p>
		<?php echo $content->get('body'); ?>
</p>



