<?php

require_once '../thinkedit.init.php';
require_once '../class/content_form.class.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

$form = new content_form('participation');

echo $form->render();


if ($form->isValid())
{
	echo '<h1>form is valid</h1>'; 
}
else
{
		echo '<h1>form is NOT valid</h1>';
}

echo '<pre>';
print_r ($form->getContentAsArray());


//echo te_admin_toolbox();
?>
