<?php
require_once '../../thinkedit.init.php';
include_once('ecard_functions.php');

if (isset($_SESSION['ecard']['message']))
{
		$message = $_SESSION['ecard']['message'] . ' - '  . $_SESSION['ecard']['from_name'] . ' (' . $_SESSION['ecard']['from_email'] . ') ';
}
else
{
		$message = 'pas de message';
}



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

draw_card($message, $template->getRealPath(), $image->getRealPath());
?>
