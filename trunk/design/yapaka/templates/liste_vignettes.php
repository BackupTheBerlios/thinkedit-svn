<?php include te_design_path() . '/content_header.php'; ?>

<?php if ($content->get('sub_title') <> ''): ?>
<div class="content_title">
<?php echo $content->get('sub_title'); ?>
</div>
<?php else: ?>
<div class="content_title">
<?php echo $content->get('title'); ?>
</div>
<?php endif; ?>

<?php if (!$content->get('body')): ?>
<div class="intro">
<?php echo $content->get('intro'); ?>
</div>
<?php endif; ?>

<div class="content_text">
<?php echo $content->get('body'); ?>
</div>

<hr/>
<br/>

<?php $children =  $node->getChildren(); ?>
<?php if ($children) : ?>
		
				
				<?php foreach ($children as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				
				if ($sub_content->get('cover'))
				{
					
						$cover_file = $sub_content->field['cover']->getFilesystem();
				}
				else
				{
						$cover_file = false;
				}
				
				?>
						<?php if ($sub_content->isUsedIn('navigation')): ?>
		
										<div class="vignette">
										<a href="<?php echo te_link($child);?>">
										<?php if ($cover_file): ?>
										<img src="<?php echo $cover_file->getThumbnail(array('w' => 80, 'h' => 80, 'zc' => 1))?>" alt="<?php echo te_short($sub_content->getTitle(), 50); ?>" title="<?php echo te_short($sub_content->get('body'), 200)?>">
										<?php else: ?>
										<img src="<?php echo te_design();?>/sources/vignette.gif" alt="<?php echo te_short($sub_content->getTitle(), 50); ?>" title="<?php echo te_short($sub_content->get('body'), 200)?>">
										<?php endif; ?>
										<br/>
										<div class="vignette_title">
										<?php echo te_short($sub_content->getTitle(), 30); ?>
										</div>
										</a>
										</div>
		
						<?php endif;?>
				
						<?php if (te_every(3)): ?>
						<div class="clear"></div>
						<?php endif; ?>
						
				<?php endforeach; ?>
		
<?php endif;?>


<?php 
// include 'comment.php'; 
?>

<?php include te_design_path() . '/content_footer.php'; ?>


