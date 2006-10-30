<?php include te_design_path() . '/content_header.php'; ?>

<?php if ($content->get('sub_title') <> ''): ?>
<div class="content_title">
<?php echo $content->get('sub_title'); ?>
</div>
<?php endif; ?>

<div class="intro">
<?php echo $content->get('intro'); ?>
</div>

<div class="content_text">
<?php echo $content->get('body'); ?>
</div>


<?php $children =  $node->getChildren(); ?>
<?php if ($children) : ?>
		<ul>
				<?php foreach ($children as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				?>
						<?php if ($sub_content->isUsedIn('navigation')): ?>
								<li>
										<a href="<?php echo te_link($child);?>">
										<?php echo $sub_content->getTitle(); ?>
										</a>
								</li>
						<?php endif;?>
				
				<?php endforeach; ?>
		</ul>
<?php endif;?>


<?php 
// include 'comment.php'; 
?>

<?php include te_design_path() . '/content_footer.php'; ?>


