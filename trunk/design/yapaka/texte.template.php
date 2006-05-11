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


<?php if ($content->get('intro')): ?>
<div class="publication_intro">
<?php echo $content->get('intro'); ?>
</div>
<?php endif;?>


<?php if ($content->get('body')): ?>
<div class="publication_body">
<?php echo $content->get('body'); ?>
</div>
<?php endif;?>



<?php if ($content->get('authors')): ?>
<div class="publication_authors">
<?php echo $content->get('authors'); ?>
</div>
<?php endif;?>


<br/>
<br/>

<?php $pdf = $content->field['pdf']->getFilesystem();?>
<?php if ($pdf): ?>
<div class="pdf_download">
<a href="<?php echo $pdf->getUrl(); ?>">
<img src="<?php echo te_design()?>/sources/pdf_small.gif" class="texte_pdf_icon"/>
Téléchargez ce texte en format pdf en cliquant ici (<?php echo $pdf->getSize(); ?>)
</a>
</div>
<?php endif;?>


<?php include 'content_footer.php'; ?>
