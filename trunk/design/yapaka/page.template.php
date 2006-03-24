<?php include 'content_header.php'; ?>

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


<?php if ($node->hasChildren(true)) : ?>
		
		<?php foreach ($node->getChildren(true) as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				?>
				<div class="title_intro">
				<a href="<?php echo te_link($child);?>">
				<?php echo $sub_content->getTitle(); ?>
				</a>
				</div>
				<div class="intro">
				<?php echo $sub_content->get('intro'); ?>
				<br/>
				<a href="<?php echo te_link($child);?>" class="link_intro color100">Entrez &gt;</a>
				</div>
		<?php endforeach; ?>
<?php endif;?>

<?php include 'content_footer.php'; ?>


