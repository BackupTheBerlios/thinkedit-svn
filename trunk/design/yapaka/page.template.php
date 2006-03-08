<h1><?php echo $content->getTitle() ?></h1>

<p>
		<?php echo $content->get('intro'); ?>
</p>

<?php if ($node->hasChildren(true)) : ?>
		<?php foreach ($node->getChildren(true) as $child): ?>
		<?php
		$sub_content = $child->getContent();
		$sub_content->load();
		?>
		
		<h2><a href="<?php echo te_link($child);?>"><?php echo $sub_content->getTitle(); ?></a></h2>
		<p>
		<?php echo $sub_content->get('intro'); ?>
		</p>
		
		<?php endforeach; ?>
<?php endif; ?>

<?php echo $content->get('body'); ?>
