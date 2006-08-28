<?php /**************** Affichage liste de commentaires *******************/ ?>


<?php if ($forums = $node->getChildren(array('type' => 'forum'))): ?>

<?php foreach ($forums as $forum): ?>

<br/>
<hr>

<?php $forum_content = $forum->getContent(); ?>
<h1><?php echo $forum_content->get('title');?></h1>

<p><?php echo $forum_content->get('intro');?></p>

<?php $discussions = $forum->getChildren(array('type' => 'discussion')); ?>
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




<?php /**************** affichage formulaire de participation *******************/ ?>

<?php
require_once ROOT . '/class/participation.class.php';

$participation = new participation('discussion');


$participation->setParentNode($discussion_node);

// définition des variables importantes : 
$participation->title = 'Donnez votre avis';
$participation->success_message = 'Votre message a bien été envoyé, il sera validé et ajouté sur le site';
$participation->failure_message = 'Problème technique : votre message n\'a pas été envoyé';
$participation->invalid_message = 'Votre message n\'est pas valable : certains champ doivent être remplis correctement. Vérifiez ci dessous et ré-essayez';
$participation->enable_moderation = false;

// personne qui reçoit un mail quand il y a du neuf 
$participation->notification_email = 'philippe.jadin@cfwb.be';
$participation->notification_email_subject = 'Un commentaire sur yapaka.be : ';


$participation->handlePost();

print_r($participation);

echo $participation->render();

?>

<?php endforeach; ?>
<?php endif; ?>




<!--



<?php
// affichage du formulaire
require_once ROOT . '/class/html_form.class.php';

$discussion = $thinkedit->newRecord('discussion');

$form = new html_form();
$form->url->set('refresh', 1);

include(ROOT . '/lib/securimage/securimage.php');
$img = new securimage();

if ($form->isSent())
{
		$discussion->setArray($_POST);
		
		//if ($img->check($_POST['code']))
		//{
				$discussion->setArray($_POST);
				$discussion->insert();
				$new_node = $forum->add($discussion);
				$new_node->moveBottom();
				
				
				$new_node->set('publish', 1);
				$new_node->save();
				$new_node->rebuild();
				
				
				$thinkedit->outputcache->end();
				if ($thinkedit->outputcache->get($cache_id))
				{
						$thinkedit->outputcache->remove($cache_id);
				}
				
				
				if ($new_node)
				{
						echo '<div class="info">Votre commentaire a bien été envoyé. Il sera ajouté d\'ici peu. Merci !</div>';
				}
				else
				{
						echo '<div class="info">Problème technique, votre commentaire n\'a pas été ajouté</div>';
				}
	//	}
		//else
	//	{
	//			echo '<div class="info">Vous n\'avez pas tapé le bon code. Veuillez réessayer afin que votre message soit posté.</div>';
	//	}
		
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

$form->add('<div>');
$form->add('Entrez le code ci-dessous (pour éviter les spams) :');
$form->add('<br/>');
$form->add('<input type="text" name="code" />');
$form->add('<br/>');
$form->add('<img src="'. ROOT_URL  .'/lib/securimage/securimage_show.php">');
$form->add('<br/>');
$form->add('</div>');

echo $form->render();

?>
<?php endforeach; ?>
<?php endif; ?>


-->

