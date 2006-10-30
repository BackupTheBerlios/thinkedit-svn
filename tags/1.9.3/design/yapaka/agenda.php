<?php
require_once ROOT . '/class/participation.class.php';

$participation = new participation('annonce');

// définition des variables importantes : 
$participation->title = 'Proposez un événement';
$participation->success_message = 'Votre contribution a bien été envoyée, elle sera validée et ajoutée sur le site';
$participation->failure_message = 'Problème technique : votre message n\'a pas été envoyé';
$participation->invalid_message = 'Votre contribution n\'est pas valable : certains champ doivent être remplis correctement. Vérifiez ci-dessous et ré-essayez';
//$participation->enable_moderation = false;

// personne qui reçoit un mail quand il y a du neuf 
$participation->notification_email = 'philippe.jadin@cfwb.be';
$participation->notification_email_subject = 'Un événement sur yapaka.be : ';

// gère les posts le cas échéant
$participation->handlePost();
?>



<?php $annonces = $node->getChildren(array('type' => 'annonce')); ?>
<?php if ($annonces): ?>
<br/>
<br/>
<br/>
<hr/>
<h1>Les annonces</h1>
<?php foreach ($annonces as $annonce_node): ?>
<?php $annonce_content = $annonce_node->getContent(); ?>
<div class="annonce">

<b><?php echo $annonce_content->get('title');?></b>

<?php if ($annonce_content->get('intervenants')): ?>
, <?php echo $annonce_content->get('intervenants');?>
<?php endif; ?>

<?php if ($annonce_content->get('lieu')): ?>
- <?php echo $annonce_content->get('lieu');?>
<?php endif; ?>

<?php if ($annonce_content->get('cout')): ?>
(<?php echo $annonce_content->get('cout');?>)
<?php endif; ?>


<p>
[contact] 

<?php if ($annonce_content->get('site')): ?> 
<a href="http://<?php echo $annonce_content->get('site');?>"><?php echo $annonce_content->get('organisateur');?></a>
<?php else: ?>
<?php echo $annonce_content->get('organisateur');?>
<?php endif; ?>

<?php if ($annonce_content->get('email')): ?> 
<a href="mailto:<?php echo $annonce_content->get('email');?>"><?php echo $annonce_content->get('email');?></a>
<?php endif; ?>



</p>


</div>
<?php endforeach; ?>
<br/>
<br/>
<br/>
<?php endif; ?>



<?php

// affiche le formulaire
echo $participation->render();
?>
