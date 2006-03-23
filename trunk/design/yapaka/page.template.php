<?php include 'content_header.php'; ?>



<?php if ($node->hasChildren(true)) : ?>
		<div class="intro">
		<?php echo $content->get('intro'); ?>
		</div>
		<?php foreach ($node->getChildren(true) as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				?>
				<div class="title_intro">
				<?php echo $sub_content->getTitle(); ?>
				</div>
				<div class="intro">
				<?php echo $sub_content->get('intro'); ?>
				<br/>
				<a href="<?php echo te_link($child);?>" class="link_intro color100">Entrez &gt;</a>
				</div>
		<?php endforeach; ?>
<?php else: ?>
		<div class="content_title">
		<?php echo $content->getTitle(); ?>
		</div>
		<div class="content_text">
		<?php echo $content->get('body'); ?>
		</div>
<?php endif;?>

<?php include 'content_footer.php'; ?>


