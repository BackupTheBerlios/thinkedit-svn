
<?php $discussions = $node->getChildren(array('type' => 'discussion')); ?>
<?php if ($discussions): ?>
<h1>Les commentaires</h1>
		<?php foreach ($discussions as $discussion_node): ?>
				<?php $discussion_content = $discussion_node->getContent(); ?>
				<div class="discussion">
				<h3><?php echo $discussion_content->get('title');?></h3>
				Posté le <?php echo $discussion_content->get('posted');?> par <?php echo $discussion_content->get('name');?>
				<p>
				<?php echo nl2br($discussion_content->get('body'));?>
				</p>
				</div>
		<?php endforeach; ?>
<?php endif; ?>


<h1>Donnez votre avis !</h1>


<?php
// affichage du formulaire
require_once ROOT . '/class/html_form.class.php';

$discussion = $thinkedit->newRecord('discussion');

$form = new html_form();
$form->url->set('refresh', 1);

if ($form->isSent())
{
		$discussion->setArray($_POST);
		$discussion->insert();
		$new_node = $node->add($discussion);
		$new_node->moveBottom();
		
		
		$thinkedit->outputcache->end();
		
		if ($thinkedit->outputcache->get($cache_id))
		{
				$thinkedit->outputcache->remove($cache_id);
		}
		
		
		if ($new_node)
		{
		echo '<div class="info">Votre commentaire a bien été envoyé. Il sera ajouté d\'ici peu après modération. Merci !</div>';
		}
		else
		{
				echo '<div class="info">Problème technique, votre commentaire n\'a pas été ajouté</div>';
		}
		
}

if ($form->isCancel())
{
		echo '<div class="info">Commentaire annulé</div>';
}

$form->setConfirmLabel('Envoyer');

foreach ($discussion->field as $field)
{
		if ($field->getType() <> 'id' && $field->isUsedIn('public'))
		{
				$form->add('<div>');
				$form->add($field->getTitle() .' :');
				$form->add('<br/>');
				$form->add($field->renderUi());
				$form->add('<br/>');
				$form->add('<br/>');
				$form->add('</div>');
		}
}
echo $form->render();

?>
