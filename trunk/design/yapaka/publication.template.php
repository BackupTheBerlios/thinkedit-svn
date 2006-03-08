<h1><?php echo $content->getTitle() ?></h1>


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



