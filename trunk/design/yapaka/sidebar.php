<?php if (isset($sidebar_image)): ?>
<img src="<?php echo $sidebar_image->getThumbnail(array('w' => 170) ); ?>"/>
<br/>
<br/>
<?php endif; ?>


<?php if ($news = $node->getChildren(array('type'=>'news'))): ?>
<?php foreach ($news as $actu): ?>

<?php $actu_content = $actu->getContent(); ?>

<a class="<?php echo te_get_section_name($actu) ?>_sub" href="<?php echo te_link($actu); ?>">
<img src="<?php echo te_design() ?>/sources/fleche.gif">
<?php echo te_short($actu_content->get('title'), 25); ?>
</a>

<?php endforeach; ?>
<br/>
<br/>
<?php endif; ?>

<?php include('relations.template.php'); ?>
