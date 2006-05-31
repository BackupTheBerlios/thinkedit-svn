<?php include 'content_header.php'; ?>

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

<?php
// render thumbnail

if ($content->get('cover'))
{
		$file = $content->field['cover']->getFilesystem();
		if ($file)
		{
				$sidebar_image = $file;
		}
}

?>


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
				
				
				
				<div class="title_intro">
				<a href="<?php echo te_link($child);?>">
				<?php echo $sub_content->getTitle(); ?>
				</a>
				</div>
				
				
				<?php /*
				<?php if ($sub_content->get('cover')): ?>
				<?php $sub_content_file = $sub_content->field['cover']->getFilesystem(); ?>
					<?php if ($sub_content_file): ?>
						<div class="cover_intro">
						<a href="<?php echo te_link($child);?>">
						<img src="<?php echo $sub_content_file->getThumbnail(array('w'=>80, 'h'=>80, 'zc'=>1)); ?>"/>
						</a>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				*/ ?>
				
				
				
				<div class="intro">
				<?php if ($sub_content->get('intro')): ?>
				<?php echo te_short($sub_content->get('intro'), 200); ?>
				<?php else: ?>
				<?php echo te_short($sub_content->get('body'), 200); ?>
				<?php endif; ?>
				<br/>
				<a href="<?php echo te_link($child);?>" class="link_intro color100">Entrez &gt;</a>
				</div>
				<?php endif; ?>
				
		<?php endforeach; ?>
		</div>
<?php endif;?>


<?php 
include 'comment.php'; 
?>


<?php include 'content_footer.php'; ?>


