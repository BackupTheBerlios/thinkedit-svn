<h1><?php echo $content->getTitle() ?></h1>

<p>
		<?php echo $content->get('intro'); ?>
</p>

<?php if ($node->hasChildren(true)) : ?>
		
<?php $count = count($node->getChildren(true)) ?>
<?php $i=0 ?>

<table border="0" width="100%">
<tr valign="top">
<td>
		<?php foreach ($node->getChildren(true) as $child): ?>
		<?php
		$sub_content = $child->getContent();
		$sub_content->load();
		?>
		
		<h2><a href="<?php echo te_link($child);?>"><?php echo $sub_content->getTitle(); ?></a></h2>
		<p>
		<?php echo $sub_content->get('intro'); ?>
		<br/>
		<a href="<?php echo te_link($child);?>" class="link_intro color100">Entrez &gt;</a>
		</p>
		<?php $i++?>
		
		<?php if ($i == ($count / 2)): ?>
		</td>
		<td>
		<?php endif; ?>
		<?php endforeach; ?>

</td>
</tr>
</table>
		
		
<?php endif; ?>

<?php echo $content->get('body'); ?>
