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
				<?php foreach ($children as $child): ?>
				<?php
				$sub_content = $child->getContent();
				$sub_content->load();
				?>
				<div>
				<?php if ($sub_content->isUsedIn('navigation')): ?>
								<div>
								<?php echo $sub_content->getTitle(); ?>
								
								<?php if ($sub_content->get('intro')): ?>
								<?php echo $sub_content->get('intro') ?>
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
								<?php echo $sub_content->get('url') ?>
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
								
								
								</div>
						<?php endif;?>
				</div>

				<?php endforeach; ?>

<?php endif;?>


<?php 
// include 'comment.php'; 
?>

<?php include te_design_path() . '/content_footer.php'; ?>


