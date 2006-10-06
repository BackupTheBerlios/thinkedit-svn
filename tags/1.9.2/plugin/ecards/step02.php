<?php
require_once '../../thinkedit.init.php';

// vérif image dans session
if (isset($_SESSION['ecard']['image']))
{
		$image = $thinkedit->newFilesystem();
		$image->setPath($_SESSION['ecard']['image']);
		
}
else
{
		die('pas d\'image demandée');
}

// Vérification que c'est bien une image
if (!$image->isImage())
{
		die('image non trouvée');
}


function checkmail($mail)
{
		if (eregi("^[0-9a-z]([-_.~]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,4}$",$mail))
		{
				return true;
		}
		else
		{
				return false;
		}
} 


if (!checkmail($_REQUEST['from_email']))
{
		die("L'adresse email de l'expéditeur n'est pas valide, utilisez le bouton précédent pour la corriger");
}


if (!checkmail($_REQUEST['to_email']))
{
		die("L'adresse email du destinataire n'est pas valide, utilisez le bouton précédent pour la corriger");
}


if (empty($_REQUEST['message']))
{
		die("Le message est vide, utilisez le bouton précédent pour la corriger");
}


// sauvegarde du formulaire dans session
$_SESSION['ecard']['from_email'] = $_REQUEST['from_email'];
$_SESSION['ecard']['from_name'] = $_REQUEST['from_name'];
$_SESSION['ecard']['to_email'] = $_REQUEST['to_email'];
$_SESSION['ecard']['message'] = $_REQUEST['message'];

$_SESSION['ecard']['message'] = str_replace("\n", '', $_SESSION['ecard']['message']);
$_SESSION['ecard']['message'] = str_replace("\r", '', $_SESSION['ecard']['message']);

/*
echo '<pre>';
print_r($_SESSION['ecard']);
*/


// génération support captcha

require_once ROOT . '/class/captcha.class.php';
$captcha = new captcha();


// affichage template
include 'step2.template.php';


?>
