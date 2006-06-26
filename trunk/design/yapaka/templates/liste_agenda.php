<?php include te_design_path() . '/content_header.php'; ?>


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



<?php include te_design_path() . '/agenda.php' ?>


<?php include te_design_path() . '/content_footer.php'; ?>


