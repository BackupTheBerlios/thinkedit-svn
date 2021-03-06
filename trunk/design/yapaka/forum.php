<?php if ($forums = $node->getChildren(array('type' => 'forum'))): ?>

<?php
// on ne prend que le premier forum défini dans ce node, pour ne pas avoir plusieurs forums sur une même page
$forum = $forums[0]; 
$forum_content = $forum->getContent();

?>




<?php
require_once ROOT . '/class/participation.class.php';

$participation = new participation('discussion');

$participation->setParentNode($forum);

// définition des variables importantes : 
$participation->title = $forum_content->getTitle();
$participation->success_message = 'Votre message a bien été posté !';
$participation->failure_message = 'Problème technique : votre message n\'a pas été envoyé';
$participation->invalid_message = 'Votre message n\'est pas valable : certains champ doivent être remplis correctement. Vérifiez ci dessous et ré-essayez';

$participation->enable_moderation = false;
$participation->enable_captcha = true;
$participation->captcha_title = 'Vérification';
$participation->captcha_help = 'Veuillez entrer le code ci dessous pour vérifier que vous êtes un humain';
$participation->captcha_error = 'Le code que vous avez entré n\'est pas le bon';


// personne qui reçoit un mail quand il y a du neuf 
$participation->notification_email = 'coordination.maltraitance@cfwb.be';
$participation->notification_email_subject = 'Un commentaire sur yapaka.be : ';


$participation->handlePost();

//print_r($participation);

?>



<?php $discussions = $forum->getChildren(array('type' => 'discussion')); ?>
<?php if ($discussions): ?>
<br/>
<br/>
<br/>
<hr/>
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
<br/>
<br/>
<br/>
<?php endif; ?>

<?php
echo $participation->render();
?>

<?php endif; ?>



