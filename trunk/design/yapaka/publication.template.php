<?php include 'content_header.php'; ?>

<div class="content_title"><?php echo $content->getTitle() ?></div>

<?php
// render thumbnail
$file = $content->field['cover']->getFilesystem();
if ($file)
{
		$sidebar_image = $file;
}

?>



<div class="publication_intro">
<?php echo $content->get('intro'); ?>
</div>

<div class="publication_body">
<?php echo $content->get('body'); ?>
</div>


<?php include 'content_footer.php'; ?>
