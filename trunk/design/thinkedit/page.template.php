<?php echo $content->get('body'); ?>


<?php $children =  $node->getChildren(); ?>
<?php if ($children) : ?>

<hr><br/>
		
<div class="content_text">
		<?php foreach ($children as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				?>
				
				<?php if ($sub_content->isUsedIn('navigation')): ?>
				
				<div class="child_title">
				<a href="<?php echo te_link($child);?>">
				<?php echo $sub_content->getTitle(); ?>
				</a>
				</div>
				
				
				<div class="child_intro">
				<?php if ($sub_content->get('intro')): ?>
				<?php echo te_short($sub_content->get('intro'), 200); ?>
				<?php else: ?>
				<?php echo te_short($sub_content->get('body'), 200); ?>
				<?php endif; ?>
				<br/>
				<a href="<?php echo te_link($child);?>" class="link_intro color100">Enter &gt;</a>
				</div>
				<?php endif; ?>
				
		<?php endforeach; ?>
		</div>
<?php endif;?>



