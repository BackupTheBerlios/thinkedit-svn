<?php
require_once ROOT . '/class/participation.class.php';

$participation = new participation('discussion');
// définition des variables importantes : 
$participation->title = 'Donnez votre avis';

$participation->success_message = 'Votre message a bien été envoyé, il sera validé et ajouté sur le site';
$participation->failure_message = 'Problème technique : votre message n\'a pas été envoyé';
$participation->invalid_message = 'Votre message n\'est pas valable : certains champ doivent être remplis correctement. Vérifiez ci dessous et ré-essayez';
$participation->enable_moderation = false;

// personne qui reçoit un mail quand il y a du neuf 
$participation->notification_email = 'philippe.jadin@cfwb.be';
$participation->notification_email_subject = 'Un commentaire sur yapaka.be : ';

echo $participation->render();


?>
