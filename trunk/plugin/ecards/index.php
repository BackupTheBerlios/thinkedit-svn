<?php
require_once '../../thinkedit.init.php';

// check que l'on a une image passée en paramètre. Son url doit être utilisable par phpthumb et ouvrable localement
// elle doit d'ailleur se situer dans le dossier "filesystem" de thinkedit
if (isset($_REQUEST['image']))
{
		// mise en session de l'image
		$_SESSION['ecard']['image'] = $_REQUEST['image'];
		
		$image = $thinkedit->newFilesystem();
		$image->setPath($_REQUEST['image']);
		
}
elseif (isset($_SESSION['ecard']['image']))
{
		$image = $thinkedit->newFilesystem();
		$image->setPath($_SESSION['ecard']['image']);
}
else
{
		die('pas d\'image demandée');
}


// idem pour le template

if (isset($_REQUEST['template']))
{
		// mise en session de l'image
		$_SESSION['ecard']['template'] = $_REQUEST['template'];
		
		$template = $thinkedit->newFilesystem();
		$template->setPath($_REQUEST['template']);
		
}
elseif (isset($_SESSION['ecard']['template']))
{
		$template = $thinkedit->newFilesystem();
		$template->setPath($_SESSION['ecard']['template']);
}
else
{
		die('pas de template demandé');
}




// si oui, fabricaton du lien
if ($image->isImage())
{
		
}
else
{
		die('image non trouvée');
}

// idem template
if ($template->isImage())
{
		
}
else
{
		die('template non trouvé');
}

// reprise ancienne donnée depuis la session si présents :
if (isset($_SESSION['ecard']['from_email']))
{
		$from_email = $_SESSION['ecard']['from_email'];
}
else
{
		$from_email = '';
}

if (isset($_SESSION['ecard']['from_name']))
{
		$from_name = $_SESSION['ecard']['from_name'];
}
else
{
		$from_name = '';
}

if (isset($_SESSION['ecard']['to_email']))
{
		$to_email = $_SESSION['ecard']['to_email'];
}
else
{
		$to_email = '';
}

if (isset($_SESSION['ecard']['message']))
{
		$message = $_SESSION['ecard']['message'];
}
else
{
		$message = '';
}



// affichage template
include 'step1.template.php';


?>
