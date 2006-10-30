<?php include te_design_path() . '/content_header.php'; ?>

<script type="text/javascript">
<!--
function toggle_visibility(id) {
		var e = document.getElementById(id);
		if(e.style.display == 'none')
		{
				e.style.display = 'block';
		}
		else
		{
				e.style.display = 'none';
		}
}
//-->
</script>


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
								
								<a href="" onclick="toggle_visibility('content_<?php echo $sub_content->getId(); ?>'); return false">
								<div class="adresse_title"><?php echo $sub_content->getTitle(); ?></div>
								</a>
								
					
								<div id="content_<?php echo $sub_content->getId(); ?>" class="adresse_content" style="display: none">
								
								<?php if ($sub_content->get('intro')): ?>
								<div class="intro">
								<?php echo $sub_content->get('intro') ?>
								</div>
								<?php endif; ?>
								
								<?php if ($sub_content->get('adresse')): ?>
								<div class="adresse_icon">
								<img src="<?php echo te_design(); ?>/sources/home.gif" class="bgcolor100">
								</div>
								<div class="adresse_info">
								<?php echo nl2br($sub_content->get('adresse')) ?>
								</div>
								<?php endif; ?>
								
								<?php if ($sub_content->get('telephone')): ?>
								<div class="adresse_icon">
								<img src="<?php echo te_design(); ?>/sources/phone.gif" class="bgcolor100">
								</div>
								<div class="adresse_info">
								<?php echo $sub_content->get('telephone') ?>
								</div>
								<?php endif; ?>
								
								<?php if ($sub_content->get('url')): ?>
								<div class="adresse_icon">
								<img src="<?php echo te_design(); ?>/sources/addressbook.gif" class="bgcolor100">
								</div>
								<div class="adresse_info">
								<a href="http://<?php echo $sub_content->get('url') ?>" target="_blank"><?php echo $sub_content->get('url') ?></a>
								</div>
								<?php endif; ?>
								
								<?php if ($sub_content->get('email')): ?>
								<div class="adresse_icon">
								<img src="<?php echo te_design(); ?>/sources/mail.gif" class="bgcolor100">
								</div>
								<div class="adresse_info">
								<?php echo $sub_content->get('email') ?>
								</div>
								<?php endif; ?>
								
								
								<hr class="adresse_separator"/>
								
								</div>
								
								
								
				<?php endif;?>
						
				</div>
				<?php endforeach; ?>

				
<?php endif;?>


<?php 
// include 'comment.php'; 
?>

<?php include te_design_path() . '/content_footer.php'; ?>


