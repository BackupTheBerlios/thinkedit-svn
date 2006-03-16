<?php if ($node->hasChildren(true)) : ?>
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
		<div class="content">
		<div class="content_text">
		<div class="content_title">
		<?php echo $content->getTitle(); ?>
		</div>
		<?php echo $content->get('body'); ?>
		</div>
		</div>
		
<?php endif;?>





