<?php include te_design_path() . '/content_header.php'; ?>


<?php if ($content->get('sub_title') <> ''): ?>
<div class="content_title">
<?php echo $content->get('sub_title'); ?>
</div>
<?php endif; ?>

<?php if ($content->get('intro') <> ''): ?>
<div class="intro">
<?php echo $content->get('intro'); ?>
</div>
<?php endif; ?>

<div class="content_text">
<?php echo $content->get('body'); ?>
</div>


<?php $children =  $node->getChildren(); ?>
<?php if ($children) : ?>

<?php foreach ($children as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				?>
				
				<?php if ($sub_content->isUsedIn('navigation')): ?>
				<h1><?php echo $sub_content->getTitle(); ?></h1>
				
				<?php if ($child->getChildren()): ?>
				<?php foreach ($child->getChildren() as $children2): ?>
				<li>
				<?php echo $children2->getTitle(); ?>
				<br/><a href="<?php echo te_link($children2); ?>" class="link_intro color100">Lire...</a>
				</li>
				<?php endforeach; ?>
				<?php endif; ?>
				
				<?php endif;?>
						
	
				<?php endforeach; ?>

				
<?php endif;?>



<?php include te_design_path() . '/content_footer.php'; ?>


