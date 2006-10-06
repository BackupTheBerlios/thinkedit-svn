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

<?php if ($content->get('intro')): ?>
<div class="intro">
<?php echo $content->get('intro') ?>
</div>
<?php endif; ?>


<?php if ($content->get('adresse')): ?>
<div class="adresse_icon">
<img src="<?php echo te_design(); ?>/sources/home.gif" class="bgcolor100">
</div>
<div class="adresse_info">
<?php echo nl2br($content->get('adresse')) ?>
</div>
<?php endif; ?>

<?php if ($content->get('telephone')): ?>
<div class="adresse_icon">
<img src="<?php echo te_design(); ?>/sources/phone.gif" class="bgcolor100">
</div>
<div class="adresse_info">
<?php echo $content->get('telephone') ?>
</div>
<?php endif; ?>

<?php if ($content->get('url')): ?>
<div class="adresse_icon">
<img src="<?php echo te_design(); ?>/sources/addressbook.gif" class="bgcolor100">
</div>
<div class="adresse_info">
<a href="http://<?php echo $content->get('url') ?>" target="_blank"><?php echo $content->get('url') ?></a>
</div>
<?php endif; ?>

<?php if ($content->get('email')): ?>
<div class="adresse_icon">
<img src="<?php echo te_design(); ?>/sources/mail.gif" class="bgcolor100">
</div>
<div class="adresse_info">
<?php echo $content->get('email') ?>
</div>
<?php endif; ?>

<?php include 'content_footer.php'; ?>


